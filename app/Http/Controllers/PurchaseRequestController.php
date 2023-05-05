<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '5000');

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Item;
use App\Models\PurchaseRequest;
use App\Models\PRItem;
use App\Models\PRRelation;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use App\Models\UserDepartment;

class PurchaseRequestController extends Controller
{
    
    public function import(Request $request)
    {
        try{
            //Fetch purchase list from bizzbox removing test data.
            $data = DB::connection("sqlsrv") -> SELECT("SELECT a.PK_TRXNO, dbo.udf_GetFullName(a.FK_ASUPost) as UserName,
                        d.PK_iwItems, d.itemdesc, d.unit, c.qty,c.qty * ISNULL(d.lastpurcprice, 0) AS Price,
                        a.docdate AS PRDate,a.remarks, b.description AS Department
                        FROM dbo.iwPRinv AS a INNER JOIN
                        dbo.mscWarehouse AS b ON a.FK_mscWarehouseFROM = b.PK_mscWarehouse INNER JOIN
                        dbo.iwPRitem AS c ON c.FK_TRXNO = a.PK_TRXNO INNER JOIN
                        dbo.iwItems AS d ON c.FK_iwItems = d.PK_iwItems
                        WHERE a.cancelflag = 0 AND a.deleteflag = 0 AND CAST(a.remarks as nvarchar(555)) NOT IN ('TESTING','WRONG ENTRY','sample entry only','Test')
                        ORDER BY a.PK_TRXNO");

            $PR_Memo_Record = array();

            // changes apply to import all products available in Purchase Ruquest
            // This is need to be able attach produrement description per product
            // Importing from BizzBox advice that it should only be imported from end of day for it will use the entire server any other request may be queed this will take time.
            
            foreach($data as $key => $val)
            {
                if(in_array($val -> PK_TRXNO, $PR_Memo_Record))
                {
                    $pr = DB::table('purchase_request') -> where('pr_no', $val -> PK_TRXNO) -> first();
                    
                    $item = DB::table('items') -> where('item_no', $val -> PK_iwItems) -> first();

                    $pritem = $this -> createPRItem($request, $val, $pr, $item);

                    $prrelation = DB::table('pr_relation') -> where('FK_pr_ID', $pr -> id) -> get();
                    
                    $dat = '';
                    try{
                        $dat = $prrelation[0] -> estimated_grand;
                    }catch(\Throwable $th){
                        return response() -> json(['message' => $th -> getMessage(),'line' => 79,'data' => $pr -> id], 500);
                    }

                    $data = [
                        'estimated_grand' => $dat + $pritem -> initial_cost,
                        'updated_at' => now()
                    ];
                    
                    DB::table('pr_relation')->where('id', $pr -> id)->update($data);
                    continue;
                }
                
                array_push($PR_Memo_Record, $val -> PK_TRXNO);
                
                $purchaseRequest = new PurchaseRequest();
                $purchaseRequest -> pr_no = $val -> PK_TRXNO;
                $purchaseRequest -> purpose = $val -> remarks ===  NULL? "NO REMARKS" : $val -> remarks ;
                $purchaseRequest -> pr_date = $val -> PRDate;
                $purchaseRequest -> created_at = now();
                $purchaseRequest -> updated_at = now();
                $purchaseRequest -> save();

                // Register product under a specific Purchase Request
                $item = DB::table('items') -> where('item_no', $val -> PK_iwItems) -> first();

                $prItem = $this -> createPRItem($request, $val, $purchaseRequest, $item);
                
                $item = DB::table('items')->where('item_no',  $val -> PK_iwItems)->first();

                $department = DB::table('department') -> where('name', $val -> Department) -> first();

                

                if($val -> UserName == NULL)
                {
                    try{
                        $this -> createPRRelation($request, $department, $purchaseRequest, $prItem, NULL);
                    }catch(\Throwable $th){
                        return response() -> json(['message' => $th -> getMessage(), 'line' => 111], 500);
                    }
                    continue;
                }

                $email =  explode(",",$val -> UserName, 2)[0].'@gmail.com';

                /**
                 * Retrieve User in DATABASE
                 */
                $user = DB::table('users') -> where('email', $email) -> first();

                /**
                 * Validate if user Exist
                 */
                if(!$user){
                    /**
                     * Register User if does not exist
                     */
                    $user = $this -> registerRequester($val -> UserName, $department);
                }  

                try{
                    $result = $this -> createPRRelation($request, $department, $purchaseRequest, $prItem, $user);
                }catch(\Throwable $th){
                    return response() -> json(['message' => $th -> getMessage(),'line' => 136],500);
                }
            }

            return response() -> json(['data' => 'Success'], 200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage() ], 500);
        }
    }
    

    public function createPRRelation($request, $department, $purchaseRequest, $prItem, $user)
    {
        // try{
            // Register Procurement for Distinct PR only
            $prrelation = new PRRelation();
            $prrelation -> FK_department_ID = $department -> id;
            $prrelation -> FK_pr_ID = $purchaseRequest -> id;
            $prrelation -> estimated_grand = $prItem -> initial_cost;
            $prrelation -> final_grand = 0.0;
            $prrelation -> FK_user_ID = $user == NULL? NULL: $user -> id;
            $prrelation -> created_at = now();
            $prrelation -> updated_at = now();
            $prrelation -> save();

            return true;
        // }catch(\Throwable $th){
        //     return $th -> getMessage();
        // }
    }

    public function createPRItem($request, $val, $purchaseRequest, $item)
    {
        try{
            $prItem = new PRItem(); 
            $prItem -> quantity = $val -> qty;
            $prItem -> unit = $val -> unit;
            $prItem -> unit_cost = $val -> Price;
            $prItem -> initial_cost = $val -> qty * $val -> Price;
            $prItem -> final_cost = 0;
            $prItem -> FK_pr_ID = $purchaseRequest -> id;
            $prItem -> FK_item_ID = $item -> id;
            $prItem -> created_at = now();
            $prItem -> updated_at = now();
            $prItem -> save(); 
            
            return $prItem;
        }catch(\Throwable $th){
            return $th -> getMessage();
        }
    }

    public function registerRequester($UserName, $department)
    {

        try{
            /**
             * Get PR requester user 
             */
            $registerUser = DB::connection('sqlsrv') -> select('SELECT PK_psDatacenter, id, fullname, fullname2, customname, mobilephone, email, prstreetbldg1, prstreetbldg2, prstreetbldg3, prbarangay, prtowncity, prprovince, prregion
                FROM dbo.psDatacenter WHERE fullname = ?',[$UserName]);

            /**
             * Register a new account for the requester
             */

            $username = explode(",",$UserName, 2)[0];
            
            if($username == '')
            {
                $username = explode(" ",$UserName, 2)[0];
            }

            $name = $username.'@gmail.com';

            if($name == '')
            {
                return 'ERROR:'.$UserName;
            }

            $user = new User();
            $user -> email = $name;
            $user -> FK_role_ID = 3;
            $user -> restrict = 0;
            $user -> password = Hash::make('CIIS2022');
            $user -> save();

            /**
             * Register Address of the requester
             */
            $address = new Address();
            try{
                $street = $registerUser[0] -> prstreetbldg1;
            }catch(\Throwable $th){
                return response() -> json(['message' => $th -> getMessage(),'line' => 238], 500);
            }
            
            /**
             * Validate for [NULL] data on third attempt if still [NULL] [street] will be [NULL]
             */
            try{
                if($street == NULL)
                {
                    $street = $registerUser[0] -> prstreetbldg2;
                    
                    if($street == NULL)
                    {
                        $street = $registerUser[0] -> prstreetbldg3;
                    }
                }
            }catch(\Throwable $th){
                return response() -> json(['message' => $th -> getMessage(), 'line' => 255], 500);
            }

            try{
                $address -> street   = $street;
                $address -> barangay = $registerUser[0] -> prbarangay;
                $address -> city = $registerUser[0] -> prtowncity;
                $address -> created_at = now();
                $address -> updated_at = now();
            }catch(\Throwable $th){
                return response() -> json(['message' => $th -> getMessage(), 'line' => 265], 500);
            }

            $address -> save();

            /**
             * Register User Profile information with default information base on what existed in bizzbox
             */
            $profile = new Profile();
            try{
                $profile -> fname = $registerUser[0] -> fullname;
                $profile -> mname = $registerUser[0] -> fullname;
                $profile -> lname = $registerUser[0] -> fullname;
                $profile -> contact = $registerUser[0] -> mobilephone;
                $profile -> FK_address_ID = $address -> id;
                $profile -> FK_user_ID = $user -> id;
                $profile -> created_at = now();
                $profile -> updated_at = now();
            }catch(\Throwable){
                return response() -> json(['message' => $th -> getMessage(), 'line' => 284], 500);
            }
            $profile -> save();

            /**
             * Associate User account in which department he/she belongs.
             */
            $userDepartment = new UserDepartment();
            $userDepartment -> FK_user_ID = $user -> id;
            $userDepartment -> FK_department_ID =  $department -> id;
            $userDepartment -> created_at = now();
            $userDepartment -> updated_at = now();
            $userDepartment -> save();

            return $user;
        }catch(\Throwable $th){
            // dd($th);
            return $th -> getMessage();
        }
    }
}

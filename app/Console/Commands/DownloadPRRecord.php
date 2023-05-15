<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Item;
use App\Models\PurchaseRequest;
use App\Models\PRItem;
use App\Models\PRRelation;

class DownloadPRRecord extends Command
{
    

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-p-r-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /**
         * State Algorith here for PR Download
         * Target to Run every Hour 
         * Validate if any new changes and updates of PR
         * if true then store to pr po issuance database
         * scheduler need to run the same time as the server is running
         * to run the Scheduler on command prompty use this command
         * php artisan schedule:work // For Local Deployment
         * php artisan schedule:run  // For Online Hosting
         * 
         * This task is important for continuous update of PR from the BizzBox and Save in the pr po issuance database
         */
        try{
            $purchaseRequestDataLength = DB::table('purchase_request') -> count();

            //Fetch purchase list from bizzbox removing test data.
            $data = DB::connection("sqlsrv") -> SELECT("SELECT a.PK_TRXNO, dbo.udf_GetFullName(a.FK_ASUPost) as UserName,
                        d.PK_iwItems, d.itemdesc, d.unit, c.qty,c.qty * ISNULL(d.lastpurcprice, 0) AS Price,
                        a.docdate AS PRDate,a.remarks, b.description AS Department
                        FROM dbo.iwPRinv AS a INNER JOIN
                        dbo.mscWarehouse AS b ON a.FK_mscWarehouseFROM = b.PK_mscWarehouse INNER JOIN
                        dbo.iwPRitem AS c ON c.FK_TRXNO = a.PK_TRXNO INNER JOIN
                        dbo.iwItems AS d ON c.FK_iwItems = d.PK_iwItems
                        WHERE a.cancelflag = 0 AND a.deleteflag = 0 AND CAST(a.remarks as nvarchar(555)) NOT IN ('TESTING','WRONG ENTRY','sample entry only','Test')
                        ORDER BY a.docdate
                        OFFSET ? ROWS
                        FETCH NEXT 20 ROWS ONLY", [$purchaseRequestDataLength]);

            $PR_Memo_Record = array();

            // changes apply to import all products available in Purchase Ruquest
            // This is need to be able attach produrement description per product
            // Importing from BizzBox advice that it should only be imported from end of day for it will use the entire server any other request may be queed this will take time.
            
            foreach($data as $key => $val)
            {

                if(in_array($PR_Memo_Record, $val['PK_TRXNO']))
                {
                    $pr = DB::table('purchase_request') -> where('pr_no', $val -> PK_TRXNO) -> first();
                    $item = DB::table('items') -> where('item_no', $val['PK_iwItems']) -> first();

                    $result = $this -> createPRItem($request, $val, $purchaseRequest, $item);

                    if(!$result)
                    {
                        continue;
                    }

                    $prrelation = DB::table('pr_relation')->where('id', $pr -> id)->first();

                    $data = [
                        'estimated_grand' => $prrelation -> estimated_grand + $item -> initial_cost,
                        'updated_at' => now()
                    ];
                    
                    DB::table('pr_relation')->where('id', $pr -> id)->update($data);
                    continue;
                }
                
                array_push($PR_Memo_Record, $val['PK_TRXNO']);
                
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

                if(!$result)
                {
                    continue;
                }

                $user = registerRequester($val -> UserName, $department);

                $result = $this -> createPRRelation($request, $department, $purchaseRequest, $prItem, $user);

            }

            Log::channel('custom-info') -> info("Download Purchase Request Record[handle] : SUCCESS");
        }catch(\Throwable $th){
            Log::channel('custom-error') -> error("Download Purchase Request Record[handle] :".$th -> getMessage());
        }
    }
    
    public function createPRRelation($request, $department, $purchaseRequest, $prItem, $user)
    {
        $path = 'app/Console/Commands/DownloadPRRecord';
        $syslogs   = new CreateLogs();

        try{

            // Register Procurement for Distinct PR only
            $prrelation = new PRRelation();
            $prrelation -> FK_department_ID = $department[0] -> id;
            $prrelation -> FK_pr_ID = $purchaseRequest -> id;
            $prrelation -> estimated_grand = $prItem -> initial_cost;
            $prrelation -> final_grand = 0.0;
            $prrelation -> FK_user_ID = now();
            $prrelation -> created_at = now();
            $prrelation -> updated_at = now();
            $prrelation -> save();

            return true;
        }catch(\Throwable $th){
            $syslogs -> Save_Logs("ERROR : ".$path."::createPRRelation : " . $th->getMessage(), "POST", 1);
            return false;
        }
    }

    public function createPRItem($request, $val, $purchaseRequest, $item)
    {
        $path = 'app/Console/Commands/DownloadPRRecord';
        $syslogs   = new CreateLogs();

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
            $syslogs -> Save_Logs("ERROR : ".$path."::createPRItem : " . $th->getMessage(), "POST", 1);
            return false;
        }
    }

    public function registerRequester($UserName, $department)
    {
        $path = 'app/Console/Commands/DownloadPRRecord';
        $syslogs   = new CreateLogs();

        try{
            /**
             * Get PR requester user 
             */
            $registerUser = DB::connection('sqlsrv') -> select('SELECT PK_psDatacenter, id, fullname, fullname2, customname, mobilephone, email, prstreetbldg1, prstreetbldg2, prstreetbldg3, prbarangay, prtowncity, prprovince, prregion
                FROM dbo.psDatacenter WHERE fullname = ?',[$UserName]);

            /**
             * Register a new account for the requester
             */
            $users = new User;

            $names = explode(" ",$registerUser['fullname'], 2);

            $user -> name  = $names[0];
            $user -> email = $names[0].'@gmail.com';
            $user -> FK_role_ID = 3;
            $user -> restrict = 0;
            $user -> password = Hash::make('CIIS2022');
            $user -> save();

            /**
             * Register Address of the requester
             */
            $address = new Address;
            $street = $registerUser['prstreetbldg1'];
            
            /**
             * Validate for [NULL] data on third attempt if still [NULL] [street] will be [NULL]
             */
            if($street == NULL)
            {
                $street = $registerUser = ['prstreetbldg2'];
                
                if($street == NULL)
                {
                    $street = $registerUser['prstreetbldg3'];
                }
            }

            $address -> street   = $street;
            $address -> barangay = $registerUser['prbarangay'];
            $address -> city = $registerUser['prtowncity'];
            $address -> created_at = now();
            $address -> updated_at = now();
            $address -> save();

            /**
             * Register User Profile information with default information base on what existed in bizzbox
             */
            $profile = new Profile;
            $profile -> fname = $registerUser['fullname'];
            $profile -> mname = $registerUser['fullname'];
            $profile -> lname = $registerUser['fullname'];
            $profile -> contact = $registerUser['mobilephone'];
            $profile -> FK_address_ID = $address['id'];
            $profile -> FK_user_ID = $user['id'];
            $profile -> created_at = now();
            $profile -> updated_at = now();
            $profile -> save();

            /**
             * Associate User account in which department he/she belongs.
             */
            $userDepartment = new UserDepartment;
            $userDepartment -> FK_user_ID = $user['id'];
            $userDepartment -> FK_department_ID =  $department['id'];
            $userDepartment -> created_at = now();
            $userDepartment -> updated_at = now();
            $userDepartment -> save();

            return $user;
        }catch(\Throwable $th){
            return NULL;
        }
    }
}

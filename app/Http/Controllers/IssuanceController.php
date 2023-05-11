<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', '5000');

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Issuance;
use App\Models\IssuanceItem;

class IssuanceController extends Controller
{
    public function index()
    {
        try{
            $data = DB::connection(env('DB_CONNECTION1')) -> SELECT('SELECT PK_TRXNO, remarks, 
                        FK_mscWarehouseDST, FK_mscWarehouseSRC, docdate, docno, totqty, 
                        totitm, regdate, postflag, cancelflag, deleteflag, amount
                        FROM dbo.iwIssinv');

            foreach($data as $key => $val)
            {

                $departmentFrom = DB::table('department') -> where('PK_warehouse', $val -> FK_mscWarehouseSRC) -> first();
                $departmentTo = DB::table('department') -> where('PK_warehouse', $val -> FK_mscWarehouseDST) -> first();

                $issuance = new Issuance;
                $issuance -> PK_TRXNO = $val -> PK_TRXNO;
                $issuance -> remarks = $val -> remarks;
                $issuance -> docno = $val -> docno;
                $issuance -> total_qty = $val -> totqty;
                $issuance -> total_items = $val -> totitm;
                $issuance -> doc_date = $val -> regdate;
                $issuance -> total_price = $val -> amount;
                $issuance -> cancel = $val -> cancelflag;
                $issuance -> FK_department_from_ID = $departmentFrom -> id;
                $issuance -> FK_department_to_ID = $departmentTo -> id;
                $issuance -> created_at = now();
                $issuance -> updated_at = now();
                $issuance -> save();

                $issuanceItem = DB::connection(env('DB_CONNECTION1')) -> SELECT('SELECT PK_iwIssitem, 
                            FK_TRXNO, FK_iwItems, FK_iwReqitem, reqno, reqdate, qty, 
                            unit, expdate, conversion,  invbalance, price, 
                            netcost FROM dbo.iwIssitem WHERE FK_TRXNO = ?', [$val -> PK_TRXNO]);
                            
                            
                foreach($issuanceItem as $key => $value)
                {
                    $item = DB::table('items') -> where('item_no', $value -> FK_iwItems) -> first();

                    $issItem = new IssuanceItem;
                    $issItem -> req_date = $value -> reqdate;
                    $issItem -> qty = $value -> qty;
                    $issItem -> exp_date = $value -> expdate;
                    $issItem -> conversion = $value -> conversion;
                    $issItem -> inv_balance = $value -> invbalance;
                    $issItem -> price = $value -> price;
                    $issItem -> netcost = $value -> netcost;
                    $issItem -> FK_item_ID = $item -> id;
                    $issItem -> FK_issuance_ID = $issuance -> id;
                    $issItem -> created_at = now();
                    $issItem -> updated_at = now();
                    $issItem -> save();
                }
            }            

            return response() -> json(['data' => $data], 200);
        }catch(\Throwable $th){
            dd($th);
            return response() -> json(['message' => $th -> getMessage()], 500);
        }
    }
}

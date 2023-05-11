<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '5000');
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Delivery;
use App\Models\DeliveryItem;

class DeliveryController extends Controller
{
    public function index()
    {
        try{
            /**
             * PK_TRXNO [String]
             * FK_mscWarehouse [Department Table]
             * terms [String]
             * docno [Int]
             * docdate [Date]
             * remarks [String]
             * pono [String]
             * curramt [double]
             */

            $data = DB::connection(env('DB_CONNECTION1')) -> SELECT("SELECT
                PK_TRXNO, FK_mscWarehouse, FK_faVendors, terms, docno,
                docdate, remarks, pono, curramt 
                FROM dbo.iwApinv WHERE CAST(remarks as nvarchar(555)) NOT IN ('wrong entry','wrong ENTRY','WRONG ENTRY','TEST', 'test', 'testing only', 
                'wrong receiving department', 'wrong entry supplier', 'WRONG ENTRY RECEIVING DEPARTMENT', 'wrong supplier', 'WRONG ENTRY')");


            $date = now();

            foreach($data as $key => $val)
            {

                $department = DB::table('department') -> where('PK_warehouse', $val -> FK_mscWarehouse) -> first();

                $delivery = new Delivery;
                $delivery -> PK_TRXNO = $val -> PK_TRXNO;
                $delivery -> Terms = $val -> terms;
                $delivery -> docno = $val -> docno;
                $delivery -> remarks = $val -> remarks;
                $delivery -> curramt = $val -> curramt;
                $delivery -> FK_department_ID = $department -> id;
                $delivery -> FK_po_ID =  $this -> filterPO($val);
                $delivery -> created_at = $val -> docdate;
                $delivery -> updated_at = $date;
                $delivery -> save();

                $deliveryItem = DB::connection(env('DB_CONNECTION1')) -> SELECT('SELECT
                    PK_iwApitem, FK_TRXNO, FK_iwItems, qty,
                    unit, conversion, vat, landcost, landamt, netamt
                    FROM dbo.iwApitem WHERE FK_TRXNO = ?
                ', [$val -> PK_TRXNO]);

                if(!$deliveryItem)
                {
                    continue;
                }

                foreach($deliveryItem as $key => $value)
                {
                    $item = DB::table('items') -> where('item_no', $value -> FK_iwItems) -> first();

                    $delivery_item = new DeliveryItem;
                    $delivery_item -> qty = $value -> qty;
                    $delivery_item -> unit = $value -> unit;
                    $delivery_item -> conversion = $value -> conversion;
                    $delivery_item -> vat = $value -> vat;
                    $delivery_item -> landcost = $value -> landcost;
                    $delivery_item -> landamt = $value -> landamt;
                    $delivery_item -> netamt = $value -> netamt;
                    $delivery_item -> FK_item_ID = $item -> id;
                    $delivery_item -> FK_delivery_ID = $delivery -> id;
                    $delivery_item -> created_at = $date;
                    $delivery_item -> updated_at = $date;
                    $delivery_item -> save();
                }
            }

            return response() -> json(['data' => 'Success'], 200);
        }catch(\Throwable $th){
            dd($th);
            return response() -> json(['message' => $th -> getMessage()], 500);
        }
    }

    public function filterPO($value)
    {

        $pattern = "/\d{2}-\d{2}-\d{4}|\d{8}/";

        
        if (strpos($value -> remarks, 'EP') !== false || strpos($value -> remarks, 'ep') !== false) {
           return NULL;
        }

        if($value -> pono != NULL)
        {
            $po = DB::table('purchase_order') -> where('po_no', $value -> pono) -> first();

            if(!$po)
            {
                return NULL;
            }

            return $po -> id;
        }

        // Extract the format using preg_match
        if (preg_match($pattern, $value -> remarks, $matches)) {
            $format = $matches[0];
            // Remove the hyphens from the format
            $format = str_replace("-", "", $format);
            
            $po = DB::table('purchase_order') -> where('po_no', $format) -> first();

            if(!$po)
            {
                return NULL;
            }

            return $po -> id;
        }

        return NULL;
    }
}

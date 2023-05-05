<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '800');

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\PurchaseOrder; 
use App\Models\PRRelation; 
use App\Models\POItem;
use App\Models\Supplier;

class PurchaseOrderController extends Controller
{
    /**
     * This import is for development Test only
     * it will move to the Purchase Order Import Scheduling module to import any latest record of Purchase Order
     */
    public function import(Request $request)
    {
        try{
            $data = DB::connection('sqlsrv') -> SELECT('SELECT po.GuarantorName AS supplier_name, pri.FK_TRXNO, prin.PK_TRXNO as PRNo, po.PONo, po.PODate, 
                po.ItemId, po.itemdesc, po.price, po.qty, po.unit, po.Amount, po.totAmount, po.remarks, po.PK_TRXNO as PO_PK_TRXNO, po.fullname, 
                po.prcontactperson, po.vatamt, po.vatincl, po.praddress, po.prtelno, po.prfaxno, po.telefax, po.mobilephone, po.ReqNo, po.mobilephone, 
                po.conversion, po.Terms, po.tinno, po.itemSpec, po.seriesNo, po.itbno, po.PK_mscProcurementList, po.description
                FROM dbo.vwReportPurchaseOrder AS po 
                LEFT JOIN dbo.iwPOitem as poi ON poi.FK_TRXNO = po.PK_TRXNO
                LEFT JOIN dbo.iwPRitem as pri ON pri.PK_iwPritem = poi.PK_iwPOitem
                LEFT JOIN dbo.iwPRinv as prin ON prin.PK_TRXNO = pri.FK_TRXNO 
            ');

            $PurchaseOrderMemoID = array();

            foreach($data as $key => $val)
            {

                /**
                 * Validate if Purchase Order number exist in Purchase Order Memo
                 */
                if(in_array($val -> PONo, $PurchaseOrderMemoID))
                {

                    $data = DB::table('purchase_order') -> where('po_no', $val -> PONo) -> first();
                    
                    if(!$data)
                    {
                        continue;
                    }

                    $item = DB::table('items') -> where('item_no', $val -> ItemId) -> first();
    
                    if(!$item)
                    { continue; }
                    
                    /**
                     * Register Purchase Order Item bind to Purchase Order ID;
                     */
                    $poitem = new POItem();
                    $poitem -> item_spec = $val -> itemSpec;
                    $poitem -> quantity = $val -> qty;
                    $poitem -> price = $val -> price;
                    $poitem -> total_price = $val -> Amount;
                    $poitem -> FK_po_ID = $data -> id;
                    $poitem -> FK_item_ID = $item -> id;
                    $poitem -> created_at = now();
                    $poitem -> updated_at = now();
                    $poitem -> save();
 
                    $updatedDetails = [
                        'total' => $data -> total + $val -> Amount,
                        'updated_at' => now()
                    ];
                    
                    DB::table('purchase_order') -> where('id', $data -> id) -> update($updatedDetails);
                    continue;
                }
                
                /**
                 * Push new Purchase Order number to memo
                 */
                array_push($PurchaseOrderMemoID, $val -> PONo);

                $pr = DB::table('purchase_request') -> where('pr_no', $val -> PRNo) -> first();

                if(!$pr)
                { continue; }

                $item = DB::table('items') -> where('item_no', $val -> ItemId) -> first();

                if(!$item)
                { continue; }

                /**
                 * Retrieve department Information use to associate Purchase Order to the right Department
                 */
                $department = DB::table('department') -> where('PK_warehouse', $val -> PK_mscProcurementList) -> first();

                /**
                 * Retrieved supplier Information to associate which Supplier of a specific Purchase Order
                 */
                $supplier = DB::table('supplier') -> where('name', $val -> supplier_name) -> first();

                /**
                 * Validate if Supplier data exist
                 * if not Register as new Supplier
                 */
                if(!$supplier)
                {
                    $supplier = new Supplier();
                    $supplier  -> name = $val -> supplier_name;
                    $supplier -> address = $val -> praddress;
                    $supplier -> created_at = now();
                    $supplier -> updated_at = now();
                    $supplier -> save();
                }

                /**
                 * Register new Purchase Order
                 */
                $purchase_order = new PurchaseOrder();
                $purchase_order -> po_no = $val -> PONo;
                $purchase_order -> po_trxno = $val -> PO_PK_TRXNO;
                $purchase_order -> po_date = $val -> PODate;
                $purchase_order -> series_number = $val -> seriesNo;
                $purchase_order -> purpose = $val -> remarks;
                $purchase_order -> caf_number = $val -> itbno;
                $purchase_order -> terms = $val -> Terms;
                $purchase_order -> procurement_mode = $val -> description;
                $purchase_order -> total = $val -> Amount;
                $purchase_order -> FK_pr_ID = $pr -> id;
                $purchase_order -> FK_department_ID = $department -> id;
                $purchase_order -> FK_supplier_ID = $supplier -> id;
                $purchase_order -> created_at = now();
                $purchase_order -> updated_at = now();
                $purchase_order -> save();

                /**
                 * Register Purchase order Item associate newly created Purchase Order
                 */
                $newPurchaseOrderItem = new POItem();
                $newPurchaseOrderItem -> item_spec = $val -> itemSpec;
                $newPurchaseOrderItem -> quantity = $val -> qty;
                $newPurchaseOrderItem -> price = $val -> price;
                $newPurchaseOrderItem -> total_price = $val -> Amount;
                $newPurchaseOrderItem -> FK_po_ID = $purchase_order -> id;
                $newPurchaseOrderItem -> FK_item_ID = $purchase_order -> id;
                $newPurchaseOrderItem -> created_at = now();
                $newPurchaseOrderItem -> updated_at = now();
                $newPurchaseOrderItem -> save();
            }

            return response() -> json(['data' => 'Success'], 200);
        }catch(\Throwable $th){
            dd($th);
            return response() -> json(['message' => $th -> getMessage()], 500);
        }
    }
}

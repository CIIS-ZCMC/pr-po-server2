<?php

namespace App\Console\Commands;

ini_set('max_execution_time', '5500');

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\Methods\ValidateCookie;
use App\Methods\CreateLogs;

use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\POItem;
use App\Models\Supplier;
use App\Models\Department;

class DownloadPORecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-p-o-record';

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
        $path = 'app/Console/Commands/DownloadPORecord';
        $syslogs   = new CreateLogs();

        try{
            $data = DB::connection('sqlsrv') -> SELECT('SELECT po.GuarantorName AS supplier_name, pri.FK_TRXNO, prin.PK_TRXNO as PRNo, po.PONo, po.PODate, 
                po.ItemId, po.itemdesc, po.price, po.qty, po.unit, po.Amount, po.totAmount, po.remarks, po.PK_TRXNO as PO_PK_TRXNO, po.fullname, 
                po.prcontactperson, po.vatamt, po.vatincl, po.praddress, po.prtelno, po.prfaxno, po.telefax, po.mobilephone, po.ReqNo, po.mobilephone, 
                po.ReqNo, po.conversion, po.Terms, po.tinno, po.itemSpec, po.seriesNo, po.itbno, po.FK_mscProcurementList, po.PK_mscProcurementList, po.description
                FROM dbo.vwReportPurchaseOrder AS po 
                LEFT JOIN dbo.iwPOitem as poi ON poi.FK_TRXNO = po.PK_TRXNO
                LEFT JOIN dbo.iwPRitem as pri ON pri.PK_iwPritem = poi.PK_iwPOitem
                LEFT JOIN dbo.iwPRinv as prin ON prin.PK_TRXNO = pri.FK_TRXNO 
                WHERE po.PONo = 22060355
            ');

            $PurchaseOrderMemoID = array();

            foreach($data as $key => $val)
            {

                /**
                 * Validate if Purchase Order number exist in Purchase Order Memo
                 */
                if(in_array($PurchaseOrderMemoID, $val['PONo']))
                {

                    $data = DB::table('purchase_order') -> where('po_no', $val['PONo']) -> get();
                    
                    continue;
                    
                    /**
                     * Register Purchase Order Item bind to Purchase Order ID;
                     */
                    $poitem = new POItem;
                    $poitem -> item_spec = $va['itemSpec'];
                    $poitem -> quantity = $val['qty'];
                    $poitem -> price = $val['price'];
                    $poitem -> total_price = $val['Amount'];
                    $poitem -> FK_item_ID = $data['id'];
                    $poitem -> created_at = now();
                    $poitem -> updated_at = now();
                    $poitem -> save();

                    $updatedDetails = [
                        'total' => $data['total'] + $val['Amount'],
                        'update_at' => now()
                    ];
                    
                    DB::table('purchase_order') -> where('id', $data['id']) -> update($updatedDetails);
                    continue;
                }
                
                /**
                 * Push new Purchase Order number to memo
                 */
                array_push($PurchaseOrderMemoID, $val['PONo']);

                /**
                 * Retrieve department Information use to associate Purchase Order to the right Department
                 */
                $department = DB::table('department') -> where('PK_warehouse', $val['PK_mscProcurementList']) -> get();

                /**
                 * Retrieved supplier Information to associate which Supplier of a specific Purchase Order
                 */
                $supplier = DB::table('supplier') -> where('name', $val['supplier_name']) -> first();

                /**
                 * Validate if Supplier data exist
                 * if not Register as new Supplier
                 */
                if(!$supplier)
                {
                    $supplier = new Supplier;
                    $suplier  -> name = $val['supplier_name'];
                    $supplier -> address = $val['praddress'];
                    $supplier -> created_at = now();
                    $supplier -> updated_at = now();
                    $supplier -> save();
                }

                /**
                 * Register new Purchase Order
                 */
                $purchase_order = new PurchaseOrder;
                $purchase_order -> po_no = $val['PONo'];
                $purchase_order -> po_trxno = $val['PO_PK_TRXNO'];
                $purchase_order -> po_date = $val['PODate'];
                $purchase_order -> series_number = $val['seriesNo'];
                $purchase_order -> purpose = $val['remarks'];
                $purchase_order -> caf_number = $val['itbno'];
                $purchase_order -> terms = $val['Terms'];
                $purchase_order -> procurement_mode = $val['description'];
                $purchase_order -> total = $val['Amount'];
                $purchase_order -> FK_pr_ID -> $val['PRNo'];
                $purchase_order -> FK_department_ID = $department[0] -> id;
                $purchase_order -> FK_supplier_ID = $supplier -> id;
                $purchase_order -> created_at = now();
                $purchase_order -> updated_at = now();
                $purchase_order -> save();

                /**
                 * Register Purchase order Item associate newly created Purchase Order
                 */
                $newPurchaseOrderItem = new POItem;
                $newPurchaseOrderItem -> item_spec = $va['itemSpec'];
                $newPurchaseOrderItem -> quantity = $val['qty'];
                $newPurchaseOrderItem -> price = $val['price'];
                $newPurchaseOrderItem -> total_price = $val['Amount'];
                $newPurchaseOrderItem -> FK_item_ID = $purchase_order['id'];
                $newPurchaseOrderItem -> created_at = now();
                $newPurchaseOrderItem -> updated_at = now();
                $newPurchaseOrderItem -> save();
            }

            $syslogs -> Save_Logs("SUCCESS : ".$path."::handle ", "POST", 1);
        }catch(\Throwable $th){
            $syslogs -> Save_Logs("ERROR : ".$path."::handle : " . $th->getMessage(), "POST", 1);
        }
    }
}

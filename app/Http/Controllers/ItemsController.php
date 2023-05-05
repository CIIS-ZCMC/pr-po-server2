<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

ini_set('max_execution_time', '2500');

use App\Models\Item;
use App\Models\ItemCategory;

class ItemsController extends Controller
{
    public function import()
    {
        try {
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_iwItems, FK_mscItemCategory, barcodeid, itemdesc, itemgroup, itemabbrev, phicprice FROM dbo.iwItems");

            foreach ($data as $key => $val) {
                $isItemExist = DB::table('items')->where('item_no', $val->PK_iwItems)->first();

                if ($isItemExist) {
                    continue;
                }
                
                $category = DB::table('category')->where('category_no', $val->FK_mscItemCategory)->first();

                $item = new Item;
                $item->item_no = $val->PK_iwItems;
                $item->barcodeid = $val->barcodeid;
                $item->description = $val->itemdesc;
                $item->abbreviation = $val->itemabbrev;
                $item->price = $val->phicprice;
                
                switch($category -> description)
                {
                    case "Food Supplies": 
                        $item -> common_office_material = 0;
                        break;
                    case "Laboratory Reagents and Supplies": 
                        $item -> common_office_material = 0;
                        break;
                    case "Books, Journals and Publications": 
                        $item -> common_office_material = 0;
                        break;
                    case "Food and Dietary Supplies": 
                        $item -> common_office_material = 0;
                        break;
                    case "Engineering and Maintenance Supplies": 
                        $item -> common_office_material = 0;
                        break;
                    case "Medical Instruments": 
                        $item -> common_office_material = 0;
                        break;
                    default:
                        $item -> common_office_material = 1;
                }

                $item->created_at = now();
                $item->updated_at = now();
                $item->save();


                $itemCategory = new ItemCategory;
                $itemCategory->FK_item_ID = $item->id;
                $itemCategory->FK_category_ID = $category->id;
                $itemCategory->created_at = now();
                $itemCategory->updated_at = now();
                $itemCategory->save();
            }

            return response()->json(['data' => 'Success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 200);
        }
    }
}

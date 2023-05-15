<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Item;
use App\Models\ItemCategory;

class DownloadItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-item';

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
        try{
            $itemDataLength = DB::table('items') -> count();
            
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_iwItems, FK_mscItemCategory, barcodeid, itemdesc, itemabbrev, phicprice FROM dbo.iwItems ORDER BY PK_iwItems LIMIT 20 OFFSET ?",[$itemDataLength]);

            foreach($data as $key => $val)
            {
                $isItemExist = DB::table('items') -> where('item_no', $val -> PK_iwItems) -> first();

                if($isItemExist)
                { continue; }

                $item = new Item;
                $item -> item_no = $val -> PK_iwItems;
                $item -> barcodeid = $val -> barcodeid;
                $item -> description = $val -> itemdesc;
                $item -> abbreviation = $val -> itemabbrev;
                $item -> price = $val -> phicprice;
                $item -> created_at = now();
                $item -> updated_at = now();
                $item -> save();

                $category = DB::table('category') -> where('category_no', $val -> FK_mscItemCategory) -> first();

                $itemCategory = new ItemCategory;
                $itemCategory -> FK_item_ID = $item -> id;
                $itemCategory -> FK_category_ID = $category -> id;
                $itemCategory -> created_at = now();
                $itemCategory -> updated_at = now();
                $itemCategory -> save();
            }

            Log::info('custom-error') -> error("Download Item[handle] : SUCCESS");
        }catch(\Throwable $th){
            Log::channel('custom-error') -> error("Download Item[handle] :".$th -> getMessage());
        }
    }
}

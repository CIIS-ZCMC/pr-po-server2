<?php

namespace App\Console\Commands;

ini_set('max_execution_time', '500');

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Category;

class DownloadCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-category-record';

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
            
            $existingDataLength = DB::table('category') -> count();

            //Fetch Category list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")
                    -> SELECT("SELECT PK_mscItemCategory, itemgroup, description FROM dbo.mscItemCategory ORDER BY PK_mscItemCategory LIMIT 20 OFFSET ?", [ $existingDataLength]);

            foreach($data as $key => $val)
            {
                $categoryExist = DB::table('category') -> where('category_no', $val -> PK_mscItemCategory) -> first();
    
                if($categoryExist)
                { continue; }
    
                $category = new Category;
                $category -> category_no = $val -> PK_mscItemCategory;
                $category -> name = $val -> description;
                $category -> description = $val -> description;
                $category -> code = $val -> itemgroup;
                $category -> created_at = now();
                $category -> updated_at = now();
                $category -> save();
            }
            
            Log::channel('custom-info') -> info("Download Category[handle] : SUCCESS");
        }catch(\Throwable $th){
            Log::channel('custom-error') -> error("Download Category[handle] :".$th -> getMessage());
        }
    }
}

<?php

namespace App\Console\Commands;

ini_set('max_execution_time', '500');

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\Methods\ValidateCookie;
use App\Methods\CreateLogs;

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
        
        $path = 'app/Console/Commands/DownloadCategory';
        $syslogs   = new CreateLogs();

        try{
            //Fetch Category list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_mscItemCategory, itemgroup, description FROM dbo.mscItemCategory");
    
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
        }catch(\Throwable $th){
            $syslogs -> Save_Logs("ERROR : ".$path."::handle : " . $th->getMessage(), "POST", 1);
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Department;

class DownloadDepartment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-department';

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
            $departmentDataLength = DB::table('department') -> count();

            $data = DB::connection("sqlsrv")
                -> SELECT("SELECT PK_mscWarehouse, description, shortname FROM dbo.mscWarehouse ORDER BY PK_mscWarehouse LIMIT 20 OFFSET ?", [$departmentDataLength]);

            
            if($departmentDataLength === count($data))
            {
                return;
            }

            foreach($data as $key => $val)
            {
                $isDepartmentExist = DB::table('department') -> where('PK_warehouse', $val -> PK_mscWarehouse) -> first();

                if($isDepartmentExist)
                { continue; }

                $department = new Department;
                $department -> PK_warehouse = $val -> PK_mscWarehouse;
                $department -> name = $val -> description;
                $department -> abbreviation = $val -> shortname;
                $department -> created_at = now();
                $department -> updated_at = now();
                $department -> save();
            }
            
            Log::channel('custom-info') -> info("Download Department[handle] : SUCCESS");
        }catch(\Throwable $th){
            Log::channel('custom-error') -> error("Download Department[handle] :".$th -> getMessage());
        }
    }
}

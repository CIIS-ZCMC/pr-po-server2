<?php

namespace App\Console\Commands;

ini_set('max_execution_time', '500');

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\Methods\ValidateCookie;
use App\Methods\CreateLogs;


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
        
        $path = 'app/Console/Commands/BackupDatabase';
        $syslogs   = new CreateLogs();

        try{
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_mscWarehouse, description, shortname FROM dbo.mscWarehouse");

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
        }catch(\Throwable $th){
            $syslogs -> Save_Logs("ERROR : ".$path."::handle : " . $th->getMessage(), "POST", 1);
        }
    }
}

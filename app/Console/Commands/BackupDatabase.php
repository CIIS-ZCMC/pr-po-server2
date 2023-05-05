<?php

namespace App\Console\Commands;

ini_set('max_execution_time', '500');

use Illuminate\Console\Command;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Spatie\Backup\Tasks\Backup\DbDumperFactory;

use App\Methods\ValidateCookie;
use App\Methods\CreateLogs;

use Spatie\DbDumper\Databases\MySql;

use Spatie\Backup\Tasks\Backup\BackupDestination\BackupName;
use Spatie\Backup\Tasks\Backup\BackupDestination\BackupDestination;


class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';


    /**
     * Execute the console command.
     */
    public function handle(): void
    {   
        $path = 'app/Console/Commands/BackupDatabase';
        $validation;

        try {
            $fileName = 'PR-PO-ISSUANCE-DB-BACKUP-'.date('Ymd').'-.sql';

            $backupResult = MySql::create()
                ->setDbName(env('DB_DATABASE'))
                ->setUserName(env('DB_USERNAME'))
                ->setPassword(env('DB_PASSWORD'))
                ->dumpToFile(resource_path('backup/'.$fileName));
            
            if ($backupResult) {
                echo "Backup successful!";
            } else {
                echo "Backup failed!";
            }
        } catch (Exception $e) {
            $syslogs -> Save_Logs("ERROR : ".$path."::handle : " . $th->getMessage(), "POST", 1);
        }
    }
}

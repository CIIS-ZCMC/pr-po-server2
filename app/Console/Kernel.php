<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\BackupDatabase;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:download-p-r-record') -> hourly(); 
        $schedule->command('app:backup-database') -> daily();
        $schedule->command('app:download-category-record') -> hourly(); 
        $schedule->command('app:download-department') -> hourly(); 
        $schedule->command('app:download-item') -> hourly(); 
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

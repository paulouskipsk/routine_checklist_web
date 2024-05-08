<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule): void {
        $schedule->command('telescope:prune --hours=48')->daily();
        $schedule->command('run:routines')->everyMinute();
        $schedule->command('routine:finish-checklists')->everyMinute(); //everyTenMinutes();        
    }

    protected function commands(): void {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

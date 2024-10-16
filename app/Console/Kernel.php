<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\VaccineManager\UpdateVaccinationStatusJob;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Command to send notifications daily
        $schedule->command('vaccination:send-notifications')->dailyAt('21:00');

        // Job to update vaccination status
        $schedule->job(new UpdateVaccinationStatusJob())->dailyAt('20:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

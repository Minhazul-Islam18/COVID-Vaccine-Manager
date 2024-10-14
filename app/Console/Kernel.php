<?php

namespace App\Console;

use App\Models\VaccineCenter;
use App\Models\VaccineRegistration;
use Illuminate\Support\Facades\Mail;
use App\Jobs\UpdateVaccinationStatusJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('vaccination:distribute')->dailyAt('08:00');

        $schedule->command('vaccination:send-notifications')->dailyAt('21:00');

        $schedule->job(new UpdateVaccinationStatusJob())->dailyAt('20:00');

        $schedule->command('auth:clear-resets')->everyFifteenMinutes();

        $schedule->command('user:prune-notifications')->dailyAt('03:05');
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

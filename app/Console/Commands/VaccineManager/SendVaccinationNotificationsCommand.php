<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VaccineRegistration;
use App\Jobs\VaccineManager\SendVaccinationNotification;

class SendVaccinationNotificationsCommand extends Command
{
    protected $signature = 'vaccination:send-notifications';
    protected $description = 'Send vaccination notifications to users scheduled for tomorrow.';

    public function handle(): void
    {
        $tomorrow = now()->addDay()->toDateString();

        $registrations = VaccineRegistration::where('vaccination_date', $tomorrow)
            ->with(['vaccineCenter:id,name'])
            ->get();

        foreach ($registrations as $registration) {
            SendVaccinationNotification::dispatch($registration);
        }

        $this->info('Vaccination notifications sent for tomorrow.');
    }
}

<?php

namespace App\Listeners\VaccineManager;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\VaccineManager\VaccineRegistrationCompletedMail;
use App\Events\VaccineManager\VaccineRegistrationCompletedEvent;
use App\Jobs\VaccineManager\DistributeVaccineDateJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailWithVaccineRegistrationData implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(VaccineRegistrationCompletedEvent $event): void
    {
        try {
            Mail::to($event->registration->email)->send(new VaccineRegistrationCompletedMail($event));

            // The date distribution job
            DistributeVaccineDateJob::dispatch();
        } catch (\Exception $e) {
            Log::error('Email could not be sent: ' . $e->getMessage());
        }
    }
}

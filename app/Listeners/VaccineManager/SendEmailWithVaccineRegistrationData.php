<?php

namespace App\Listeners\VaccineManager;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\VaccineManager\VaccineRegistrationCompletedMail;
use App\Events\VaccineManager\VaccineRegistrationCompletedEvent;

class SendEmailWithVaccineRegistrationData
{
    /**
     * Handle the event.
     */
    public function handle(VaccineRegistrationCompletedEvent $event): void
    {
        try {
            Mail::to($event->registration->email)->send(new VaccineRegistrationCompletedMail($event));
        } catch (\Exception $e) {
            Log::error('Email could not be sent: ' . $e->getMessage());
        }
    }
}

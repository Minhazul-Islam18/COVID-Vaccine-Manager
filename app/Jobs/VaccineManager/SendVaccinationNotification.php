<?php

namespace App\Jobs\VaccineManager;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\VaccineRegistration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\VaccineManager\VaccinationNotification;

class SendVaccinationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param VaccineRegistration $registration
     */
    public function __construct(public VaccineRegistration $registration) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->registration->email)
            ->send(new VaccinationNotification($this->registration));
    }
}

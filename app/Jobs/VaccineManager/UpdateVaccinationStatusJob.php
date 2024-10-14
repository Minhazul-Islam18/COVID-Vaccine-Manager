<?php

namespace App\Jobs;

use App\Enums\VaccineRegistrationStatus;
use App\Models\VaccineRegistration;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateVaccinationStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        DB::transaction(function () use ($today) {
            VaccineRegistration::where('vaccination_date', $today)
                ->chunk(100, function ($registrations) {
                    foreach ($registrations as $registration) {
                        $registration->update(['status' => VaccineRegistrationStatus::VACCINATED]);
                    }
                });
        });

        Log::info("Vaccination status updated for registrations with date: $today");
    }
}

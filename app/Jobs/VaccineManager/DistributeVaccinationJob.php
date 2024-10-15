<?php

namespace App\Jobs\VaccineManager;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Actions\VaccineManager\DistributeVaccineRegistrationsAction;

class DistributeVaccineDateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(DistributeVaccineRegistrationsAction $distributeAction): void
    {
        $distributeAction->execute();

        Log::info('Vaccine date distribution completed.');
    }
}

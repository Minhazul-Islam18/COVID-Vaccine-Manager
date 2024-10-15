<?php

namespace App\Actions\VaccineManager;

use App\Models\VaccineRegistration;
use Illuminate\Support\Facades\Log;
use App\Events\VaccineManager\VaccineRegistrationCompletedEvent;
use App\Http\Requests\VaccineManager\VaccineRegistrationRequest;

class RegisterVaccineAction
{
    /**
     * Executes the vaccine registration process.
     */
    public function execute(VaccineRegistrationRequest $request): void
    {
        // Create New Vaccine requester
        $registration = VaccineRegistration::create($request->validated());

        // Eager load related vaccine center data
        $registration->load('vaccineCenter:id,name');

        // Dispatch the event to trigger further Mail sending and Vaccination date queued actions
        VaccineRegistrationCompletedEvent::dispatch($registration);

        // Finally, This Log let us know is everything was perfect.
        Log::info("Vaccine registration completed for NID: " . $registration->nid);
    }
}

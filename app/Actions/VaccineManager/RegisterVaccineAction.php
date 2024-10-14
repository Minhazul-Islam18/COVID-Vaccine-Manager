<?php

namespace App\Actions\VaccineManager;

use App\Models\VaccineRegistration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\VaccineManager\VaccineRegistrationCompletedMail;
use App\Events\VaccineManager\VaccineRegistrationCompletedEvent;
use App\Http\Requests\VaccineManager\VaccineRegistrationRequest;

class RegisterVaccineAction
{
    public function execute(VaccineRegistrationRequest $request)
    {
        $event = VaccineRegistration::create($request->validated());
        $event->load('vaccineCenter:id,name');
        VaccineRegistrationCompletedEvent::dispatch($event);
        return;
    }
}

<?php

namespace App\Actions\VaccineManager;

use App\Models\VaccineRegistration;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\VaccineManager\VaccineRegistrationRequest;

class RegisterVaccineAction
{
    public function execute(VaccineRegistrationRequest $request)
    {
        return VaccineRegistration::create($request->validated());
    }
}

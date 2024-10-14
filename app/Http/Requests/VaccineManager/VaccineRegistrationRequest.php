<?php

namespace App\Http\Requests\VaccineManager;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to submit the form (you can change this later if needed)
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'nid' => 'required|string|min:10|unique:vaccine_registrations,nid',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'nid.required' => 'NID is required.',
            'nid.unique' => 'User already registered with this NID.',
            'vaccine_center_id.required' => 'Vaccine center is required.',
        ];
    }
}

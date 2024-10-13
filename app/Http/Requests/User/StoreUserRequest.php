<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_title' => 'required|string',
            'name' => 'required|string',
            'phone' => 'string|nullable',
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')],
            'password' => 'required|min:8|confirmed',
            'roles' => 'required|array|min:1',
            'avatar' => [File::image(), 'nullable'],
        ];
    }
}

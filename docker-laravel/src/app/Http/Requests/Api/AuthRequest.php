<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use PharIo\Manifest\Email;

class AuthRequest extends FormRequest
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
            'email' =>[
                '',
                'email',
                'max:255',
            ],
            'password' =>[
                'required',
                'max:255',
            ],
            'device_name' =>[
                'required',
                'max:255',
            ],
        ];
    }
}

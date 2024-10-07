<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
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
        $rules=[
                'nome'=> 'required|max:255|unique:supports',
                'idade'=> 'required|max:3',
                'latitude'=> 'required|max:255',
                'longitude'=> 'required|max:255',
                'inventario' => [
                    'required',
                    'min:3',
                    'max:100000'

                ],
            ];

            if ($this->method() === 'PUT' || $this->method() === 'PATCH'){

                $rules ['inventario'] = [
                    'required',
                    'min:3',
                    'max:255',
                    //"unique:supports,subject,{$this->id},id"
                    Rule::unique('supports')->ignore($this->support ?? $this->id),
                ];
            }

        return $rules;
    }
}

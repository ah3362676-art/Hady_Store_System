<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => [
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'regex:/^01[0125][0-9]{8}$/',
                'max:20',
                Rule::unique('customers')
                    ->ignore($this->customer),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('customers')
                    ->ignore($this->customer),
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
                    'unique:customers,phone',
                ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:customers,email',
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

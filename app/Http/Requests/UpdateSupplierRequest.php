<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Supplier $supplier */
        $supplier = $this->route('supplier');

        return [

            'name' => ['required', 'string', 'max:255'],

            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('suppliers', 'phone')->ignore($supplier),
            ],

            'email' => ['nullable', 'email', 'max:255'],

            'address' => ['nullable', 'string'],


            'notes' => ['nullable', 'string'],

            'is_active' => ['required', 'boolean'],

        ];
    }
}

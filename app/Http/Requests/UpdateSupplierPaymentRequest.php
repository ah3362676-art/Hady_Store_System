<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplierPayment = $this->route('supplier_payment');

        return [

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],



            'payment_date' => [
                'required',
                'date',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_method' => [
                'required',
                'in:cash,vodafone_cash',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

        ];
    }
}

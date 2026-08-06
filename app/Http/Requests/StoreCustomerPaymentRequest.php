<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'customer_id' => [
                'required',
                'exists:customers,id',
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

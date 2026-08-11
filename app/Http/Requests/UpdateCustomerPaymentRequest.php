<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerPayment = $this->route('customer_payment');

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

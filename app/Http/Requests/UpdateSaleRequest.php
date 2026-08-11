<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [





            'sale_date' => [
                'required',
                'date',
            ],

            'subtotal' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'total' => [
                'required',
                'numeric',
                'min:0',
            ],

            'paid' => [
                'required',
                'numeric',
                'min:0',
            ],

            'due' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'required',
                'in:cash,vodafone_cash',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'exists:products,id',
            ],

            'items.*.sale_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

        ];
    }
}

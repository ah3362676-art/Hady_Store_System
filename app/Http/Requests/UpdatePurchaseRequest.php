<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Purchase $purchase */
        $purchase = $this->route('purchase');

        return [

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'purchase_date' => [
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
                'lte:subtotal',
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
                'lte:total',
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

            'items.*.purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'items.*.expiry_date' => [
                'nullable',
                'date',
            ],

        ];
    }
}

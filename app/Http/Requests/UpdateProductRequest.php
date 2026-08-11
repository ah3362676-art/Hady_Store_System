<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'category_id' => ['required', 'exists:categories,id'],

            'brand_id' => ['required', 'exists:brands,id'],

            'unit_id' => ['required', 'exists:units,id'],

            'name' =>
             [
             'required',
              'string',
              'max:255',
             Rule::unique('products', 'name')->ignore($this->route('product'))
             ],

             'barcode' => [
    'nullable',
    'string',
    'max:255',
    Rule::unique('products', 'barcode')->ignore($this->product),
],

            'purchase_price' => ['required', 'numeric', 'min:0'],

            'sale_price' => ['required', 'numeric', 'gte:purchase_price'],

            'minimum_sale_price' => ['required', 'numeric', 'gte:purchase_price', 'lte:sale_price'],
        //'gte:purchase_price'=>  اكبر من اوي يساوي سعر الشراء
        // lte:sale_price =>  أقل من أو يساوي سعر البيع

            'quantity' => ['required', 'integer', 'min:0'],

            'reorder_level' => ['required', 'integer', 'min:0'],

            'description' => ['nullable', 'string'],

            'is_active' => ['required', 'boolean'],

            'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
            ],

        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Unit $unit */
        $unit = $this->route('unit');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units', 'name')->ignore($unit),
            ],

            'symbol' => [
                'required',
                'string',
                'max:20',
                Rule::unique('units', 'symbol')->ignore($unit),
            ],

            'is_active' => ['required', 'boolean'],
        ];
    }
}

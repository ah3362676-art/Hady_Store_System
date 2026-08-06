<div class="rounded-xl bg-white p-6 shadow">

    <h2 class="mb-6 text-xl font-semibold">
        {{ __('messages.sale_information') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.customer') }}
            </label>

            <select
                name="customer_id"
                class="w-full rounded-lg border-gray-300">

                <option value="">
                    {{ __('messages.select_customer') }}
                </option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        @selected(old('customer_id', $sale->customer_id ?? '') == $customer->id)>

                        {{ $customer->name }}

                    </option>

                @endforeach

            </select>

            @error('customer_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            {{-- <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.invoice_number') }}
            </label> --}}

            <input
                type="hidden"
                name="invoice_number"
                value="{{ old('invoice_number', $sale->invoice_number ?? '') }}"
                class="w-full rounded-lg border-gray-300">

            @error('invoice_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.sale_date') }}
            </label>

            <input
                type="date"
                name="sale_date"
                value="{{ old('sale_date', isset($sale) ? $sale->sale_date?->format('Y-m-d') : now()->format('Y-m-d')) }}"
                class="w-full rounded-lg border-gray-300">

            @error('sale_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.payment_method') }}
            </label>

            <select
                name="payment_method"
                class="w-full rounded-lg border-gray-300">

                <option
                    value="cash"
                    @selected(old('payment_method', $sale->payment_method ?? '') == 'cash')>

                    {{ __('messages.cash') }}

                </option>

                <option
                    value="vodafone_cash"
                    @selected(old('payment_method', $sale->payment_method ?? '') == 'vodafone_cash')>

                    {{ __('messages.vodafone_cash') }}

                </option>

            </select>

            @error('payment_method')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

    </div>

    <div class="mt-6">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.notes') }}
        </label>

        <textarea
            rows="4"
            name="notes"
            class="w-full rounded-lg border-gray-300">{{ old('notes', $sale->notes ?? '') }}</textarea>

        @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

</div>

<div class="mt-8 rounded-xl bg-white p-6 shadow">

    <div class="mb-4 flex items-center justify-between">

        <h2 class="text-xl font-semibold">
            {{ __('messages.products') }}
        </h2>

        <button
            id="add-product"
            type="button"
            class="rounded-lg bg-indigo-600 px-4 py-2 text-white">

            + {{ __('messages.add_product') }}

        </button>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-4 py-3 text-left">{{ __('messages.product') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.sale_price') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.quantity') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.total') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.action') }}</th>

                </tr>

            </thead>

<tbody id="sale-items">

@if(isset($sale))

    @foreach($sale->items as $index => $item)

        <tr class="sale-row">

            <td class="p-3">

                <select
                    name="items[{{ $index }}][product_id]"
                    class="product w-full rounded-lg border-gray-300">

                    <option value="">
                        {{ __('messages.select_product') }}
                    </option>

                    @foreach($products as $product)

                        <option
                            value="{{ $product->id }}"
                            data-price="{{ $product->sale_price }}"
                            @selected($item->product_id == $product->id)>

                            {{ $product->name }}

                        </option>

                    @endforeach

                </select>

            </td>
                        <td class="p-3">

                <input
                    type="number"
                    step="0.01"
                    name="items[{{ $index }}][sale_price]"
                    value="{{ $item->sale_price }}"
                    class="sale-price w-full rounded-lg border-gray-300">

            </td>

            <td class="p-3">

                <input
                    type="number"
                    min="1"
                    name="items[{{ $index }}][quantity]"
                    value="{{ $item->quantity }}"
                    class="quantity w-full rounded-lg border-gray-300">

            </td>

            <td class="p-3">

                <input
                    type="text"
                    readonly
                    value="{{ number_format($item->total, 2, '.', '') }}"
                    class="item-total w-full rounded-lg border bg-gray-100 text-center">

            </td>

            <td class="p-3 text-center">

                <button
                    type="button"
                    class="delete-row rounded bg-red-600 px-3 py-2 text-white">

                    {{ __('messages.delete') }}

                </button>

            </td>

        </tr>

    @endforeach

@else

    <tr class="sale-row">

        <td class="p-3">

            <select
                name="items[0][product_id]"
                class="product w-full rounded-lg border-gray-300">

                <option value="">
                    {{ __('messages.select_product') }}
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        data-price="{{ $product->sale_price }}">

                        {{ $product->name }}

                    </option>

                @endforeach

            </select>

        </td>

        <td class="p-3">

            <input
                type="number"
                step="0.01"
                name="items[0][sale_price]"
                class="sale-price w-full rounded-lg border-gray-300">

        </td>

        <td class="p-3">

            <input
                type="number"
                min="1"
                value="1"
                name="items[0][quantity]"
                class="quantity w-full rounded-lg border-gray-300">

        </td>

        <td class="p-3">

            <input
                type="text"
                readonly
                value="0.00"
                class="item-total w-full rounded-lg border bg-gray-100 text-center">

        </td>

        <td class="p-3 text-center">

            <button
                type="button"
                class="delete-row rounded bg-red-600 px-3 py-2 text-white">

                {{ __('messages.delete') }}

            </button>

        </td>

    </tr>

@endif

</tbody>

        </table>

    </div>

    <div class="mt-8 border-t pt-6">

        <div class="ml-auto max-w-md space-y-4">

            <div class="flex items-center justify-between">

                <label class="font-medium">
                    {{ __('messages.subtotal') }}
                </label>

                <input
                    id="subtotal"
                    type="text"
                    name="subtotal"
                    value="{{ old('subtotal', $sale->subtotal ?? 0) }}"
                    readonly
                    class="w-40 rounded-lg border bg-gray-100 text-center">

            </div>

            <div class="flex items-center justify-between">

                <label class="font-medium">
                    {{ __('messages.discount') }}
                </label>

                <input
                    id="discount"
                    type="number"
                    step="0.01"
                    name="discount"
                    value="{{ old('discount', $sale->discount ?? 0) }}"
                    class="w-40 rounded-lg border text-center">

            </div>

            <div class="flex items-center justify-between">

                <label class="font-medium">
                    {{ __('messages.total') }}
                </label>

                <input
                    id="total"
                    type="text"
                    name="total"
                    value="{{ old('total', $sale->total ?? 0) }}"
                    readonly
                    class="w-40 rounded-lg border bg-gray-100 text-center">

            </div>

            <div class="flex items-center justify-between">

                <label class="font-medium">
                    {{ __('messages.paid') }}
                </label>

                <input
                    id="paid"
                    type="number"
                    step="0.01"
                    name="paid"
                    value="{{ old('paid', $sale->paid ?? 0) }}"
                    class="w-40 rounded-lg border text-center">

            </div>

            <div class="flex items-center justify-between">

                <label class="font-medium">
                    {{ __('messages.due') }}
                </label>

                <input
                    id="due"
                    type="text"
                    name="due"
                    value="{{ old('due', $sale->due ?? 0) }}"
                    readonly
                    class="w-40 rounded-lg border bg-gray-100 text-center">

            </div>

        </div>

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('sales.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.cancel') }}

        </a>

        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

            {{ __('messages.save_sale') }}

        </button>

    </div>

</div>

<template id="sale-row-template">

<tr class="sale-row">

    <td class="p-3">

        <select class="product w-full rounded-lg border-gray-300">

            <option value="">
                {{ __('messages.select_product') }}
            </option>

            @foreach($products as $product)

                <option
                    value="{{ $product->id }}"
                    data-price="{{ $product->sale_price }}">

                    {{ $product->name }}

                </option>

            @endforeach

        </select>

    </td>

    <td class="p-3">

        <input
            type="number"
            step="0.01"
            class="sale-price w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

        <input
            type="number"
            min="1"
            value="1"
            class="quantity w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

        <input
            type="text"
            readonly
            value="0.00"
            class="item-total w-full rounded-lg border bg-gray-100 text-center">

    </td>

    <td class="p-3 text-center">

        <button
            type="button"
            class="delete-row rounded bg-red-600 px-3 py-2 text-white">

            {{ __('messages.delete') }}

        </button>

    </td>

</tr>

</template>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const tbody = document.getElementById('sale-items');
    const template = document.getElementById('sale-row-template');

    const subtotalInput = document.getElementById('subtotal');
    const discountInput = document.getElementById('discount');
    const totalInput = document.getElementById('total');
    const paidInput = document.getElementById('paid');
    const dueInput = document.getElementById('due');

    function updateNames() {

        tbody.querySelectorAll('.sale-row').forEach((row, index) => {

            row.querySelector('.product').name =
                `items[${index}][product_id]`;

            row.querySelector('.sale-price').name =
                `items[${index}][sale_price]`;

            row.querySelector('.quantity').name =
                `items[${index}][quantity]`;

        });

    }

    function calculate() {

        let subtotal = 0;

        tbody.querySelectorAll('.sale-row').forEach(row => {

            const price =
                parseFloat(row.querySelector('.sale-price').value) || 0;

            const quantity =
                parseFloat(row.querySelector('.quantity').value) || 0;

            const itemTotal = price * quantity;

            row.querySelector('.item-total').value =
                itemTotal.toFixed(2);

            subtotal += itemTotal;

        });

        subtotalInput.value = subtotal.toFixed(2);

        const discount =
            parseFloat(discountInput.value) || 0;

        const total =
            subtotal - discount;

        totalInput.value =
            total.toFixed(2);

        const paid =
            parseFloat(paidInput.value) || 0;

        dueInput.value =
            (total - paid).toFixed(2);

    }

    document.getElementById('add-product')
        .addEventListener('click', () => {

            const clone =
                template.content.cloneNode(true);

            tbody.appendChild(clone);

            updateNames();

        });

    tbody.addEventListener('change', e => {

        if (!e.target.classList.contains('product')) {
            return;
        }

        const option =
            e.target.selectedOptions[0];

        e.target.closest('.sale-row')
            .querySelector('.sale-price')
            .value = option.dataset.price || 0;

        calculate();

    });

    tbody.addEventListener('input', e => {

        if (
            e.target.classList.contains('sale-price') ||
            e.target.classList.contains('quantity')
        ) {

            calculate();

        }

    });

    discountInput.addEventListener('input', calculate);

    paidInput.addEventListener('input', calculate);

    tbody.addEventListener('click', e => {

        if (!e.target.classList.contains('delete-row')) {
            return;
        }

        if (tbody.querySelectorAll('.sale-row').length === 1) {
            return;
        }

        e.target.closest('.sale-row').remove();

        updateNames();

        calculate();

    });

    updateNames();

    calculate();

});
</script>

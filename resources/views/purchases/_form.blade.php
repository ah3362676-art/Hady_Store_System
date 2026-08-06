<div class="rounded-xl bg-white p-6 shadow">

    <h2 class="mb-6 text-xl font-semibold">
        {{ __('messages.purchase_information') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        {{-- Supplier --}}
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.supplier') }}
            </label>

            <select
                name="supplier_id"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <option value="">
                    {{ __('messages.select_supplier') }}
                </option>

                @foreach($suppliers as $supplier)

                <option
                    value="{{ $supplier->id }}"
                    @selected(old('supplier_id', $purchase->supplier_id ?? '') == $supplier->id)>

                    {{ $supplier->name }}

                </option>

                @endforeach

            </select>

            @error('supplier_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Invoice Number --}}
        <div>

            {{-- <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.invoice_number') }}
            </label> --}}

            <input
               type="hidden"
                name="invoice_number"
                value="{{ old('invoice_number', $purchase->invoice_number ?? '') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('invoice_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        {{-- Purchase Date --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.purchase_date') }}
            </label>

            <input
                type="date"
                name="purchase_date"
                value="{{ old('purchase_date', isset($purchase) ? \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('purchase_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        {{-- Payment Method --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.payment_method') }}
            </label>

            <select
                name="payment_method"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <option
                    value="cash"
                    @selected(old('payment_method') == 'cash')>
                    {{ __('messages.cash') }}
                </option>

                <option
                    value="vodafone_cash"
                    @selected(old('payment_method') == 'vodafone_cash')>
                    {{ __('messages.vodafone_cash') }}
                </option>

            </select>

            @error('payment_method')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

    </div>

    {{-- Notes --}}
    <div class="mt-6">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.notes') }}
        </label>

        <textarea
            rows="4"
            name="notes"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>

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
                    <th class="px-4 py-3 text-center">{{ __('messages.purchase_price') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.quantity') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.expiry_date') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.total') }}</th>
                    <th class="px-4 py-3 text-center">{{ __('messages.action') }}</th>

                </tr>

            </thead>

            <tbody id="purchase-items">

@if(isset($purchase))

    @foreach($purchase->items as $index => $item)

        <tr class="purchase-row">

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
                    name="items[{{ $index }}][purchase_price]"
                    value="{{ $item->purchase_price }}"
                    class="purchase-price w-full rounded-lg border-gray-300">

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
        type="date"
        name="items[{{ $index }}][expiry_date]"
        value="{{ optional($item->expiry_date)->format('Y-m-d') }}"
        class="expiry-date w-full rounded-lg border-gray-300">

</td>

            <td class="p-3">

                <input
                    type="text"
                    readonly
                    value="{{ $item->total }}"
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

<tr class="purchase-row">

    <td class="p-3">

        <select
            name="items[0][product_id]"
            class="product w-full rounded-lg border-gray-300">

            <option value="">
                {{ __('messages.select_product') }}
            </option>
                        @foreach($products as $product)

                <option value="{{ $product->id }}">
                    {{ $product->name }}
                </option>

            @endforeach

        </select>

    </td>

    <td class="p-3">

        <input
            type="number"
            step="0.01"
            name="items[0][purchase_price]"
            class="purchase-price w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

        <input
            type="number"
            min="1"
            name="items[0][quantity]"
            value="1"
            class="quantity w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

    <input
        type="date"
        name="items[0][expiry_date]"
        class="expiry-date w-full rounded-lg border-gray-300">

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
                    value="0"
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
                    value="{{ old('discount', $purchase->discount ?? 0) }}"
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
                    value="0"
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
                    value="{{ old('paid', $purchase->paid ?? 0) }}"
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
                    value="0"
                    readonly
                    class="w-40 rounded-lg border bg-gray-100 text-center">

            </div>

        </div>

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('purchases.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.cancel') }}

        </a>

        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

            {{ __('messages.save_purchase') }}

        </button>

    </div>

</div>

<template id="purchase-row-template">

<tr class="purchase-row">

    <td class="p-3">

        <select class="product w-full rounded-lg border-gray-300">

            <option value="">
                {{ __('messages.select_product') }}
            </option>

            @foreach($products as $product)

                <option value="{{ $product->id }}">
                    {{ $product->name }}
                </option>

            @endforeach

        </select>

    </td>

    <td class="p-3">

        <input
            type="number"
            step="0.01"
            class="purchase-price w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

        <input
            type="number"
            value="1"
            min="1"
            class="quantity w-full rounded-lg border-gray-300">

    </td>

    <td class="p-3">

        <input
            type="date"
            class="expiry-date w-full rounded-lg border-gray-300">

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

    let index = 1;

    const tbody = document.getElementById('purchase-items');
    const template = document.getElementById('purchase-row-template');

    const subtotalInput = document.getElementById('subtotal');
    const discountInput = document.getElementById('discount');
    const totalInput = document.getElementById('total');
    const paidInput = document.getElementById('paid');
    const dueInput = document.getElementById('due');

    function updateNames() {

        tbody.querySelectorAll('.purchase-row').forEach((row, i) => {

row.querySelector('.product').name =
    `items[${i}][product_id]`;

row.querySelector('.purchase-price').name =
    `items[${i}][purchase_price]`;

row.querySelector('.quantity').name =
    `items[${i}][quantity]`;

row.querySelector('.expiry-date').name =
    `items[${i}][expiry_date]`;

        });

        index = tbody.querySelectorAll('.purchase-row').length;
    }

    function calculate() {

        let subtotal = 0;

        tbody.querySelectorAll('.purchase-row').forEach((row) => {

            let price =
                parseFloat(row.querySelector('.purchase-price').value) || 0;

            let qty =
                parseFloat(row.querySelector('.quantity').value) || 0;

            let total = price * qty;

            row.querySelector('.item-total').value =
                total.toFixed(2);

            subtotal += total;

        });

        subtotalInput.value = subtotal.toFixed(2);

        let discount =
            parseFloat(discountInput.value) || 0;

        let total =
            subtotal - discount;

        totalInput.value =
            total.toFixed(2);

        let paid =
            parseFloat(paidInput.value) || 0;

        dueInput.value =
            (total - paid).toFixed(2);

    }

    document
        .getElementById('add-product')
        .addEventListener('click', () => {

            const clone =
                template.content.cloneNode(true);

            tbody.appendChild(clone);

            updateNames();

        });
    tbody.addEventListener('input', function (e) {

        if (
            e.target.classList.contains('purchase-price') ||
            e.target.classList.contains('quantity')
        ) {
            calculate();
        }

    });

    discountInput.addEventListener('input', calculate);

    paidInput.addEventListener('input', calculate);

    tbody.addEventListener('click', function (e) {

        if (e.target.classList.contains('delete-row')) {

            if (tbody.querySelectorAll('.purchase-row').length === 1) {
                return;
            }

            e.target.closest('.purchase-row').remove();

            updateNames();

            calculate();

        }

    });

    updateNames();

    calculate();

});
</script>

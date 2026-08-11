<div class="rounded-xl bg-white p-6 shadow">

    <h2 class="mb-6 text-xl font-semibold">
        {{ __('messages.supplier_payment') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

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
                        @selected(old('supplier_id', $supplierPayment->supplier_id ?? '') == $supplier->id)>

                        {{ $supplier->name }}

                    </option>

                @endforeach

            </select>

            @error('supplier_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.receipt_number') }}
            </label>

            <input
                type="text"
                name="receipt_number"
                value="{{ old('receipt_number', $supplierPayment->receipt_number ?? '') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('receipt_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.payment_date') }}
            </label>

            <input
                type="date"
                name="payment_date"
                value="{{ old('payment_date', isset($supplierPayment) ? $supplierPayment->payment_date : now()->format('Y-m-d')) }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('payment_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.amount') }}
            </label>

            <input
                type="number"
                step="0.01"
                name="amount"
                value="{{ old('amount', $supplierPayment->amount ?? 0) }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.payment_method') }}
            </label>

            <select
                name="payment_method"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <option
                    value="cash"
                    @selected(old('payment_method', $supplierPayment->payment_method ?? '') == 'cash')>

                    {{ __('messages.cash') }}

                </option>

                <option
                    value="vodafone_cash"
                    @selected(old('payment_method', $supplierPayment->payment_method ?? '') == 'vodafone_cash')>

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
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $supplierPayment->notes ?? '') }}</textarea>

        @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('supplier-payments.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.cancel') }}

        </a>

        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

            {{ __('messages.save_payment') }}

        </button>

    </div>

</div>

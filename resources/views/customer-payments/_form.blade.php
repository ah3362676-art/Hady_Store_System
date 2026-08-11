<div class="rounded-xl bg-white p-6 shadow">

    <h2 class="mb-6 text-xl font-semibold">
        {{ __('messages.customer_payment') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.customer') }}
            </label>

            <select
                name="customer_id"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <option value="">
                    {{ __('messages.select_customer') }}
                </option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        @selected(old('customer_id', $customerPayment->customer_id ?? '') == $customer->id)>

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
                {{ __('messages.receipt_number') }}
            </label> --}}

            <input
                type="hidden"
                name="receipt_number"
                value="{{ old('receipt_number', $customerPayment->receipt_number ?? '') }}"
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
                value="{{ old('payment_date', isset($customerPayment) ? $customerPayment->payment_date : now()->format('Y-m-d')) }}"
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
                value="{{ old('amount', $customerPayment->amount ?? 0) }}"
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
                    @selected(old('payment_method', $customerPayment->payment_method ?? '') == 'cash')>

                    {{ __('messages.cash') }}

                </option>

                <option
                    value="vodafone_cash"
                    @selected(old('payment_method', $customerPayment->payment_method ?? '') == 'vodafone_cash')>

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
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $customerPayment->notes ?? '') }}</textarea>

        @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('customer-payments.index') }}"
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

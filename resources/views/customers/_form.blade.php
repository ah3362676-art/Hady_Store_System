<div class="rounded-xl bg-white p-6 shadow">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        {{-- Name --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.name') }}
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $customer->name ?? '') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>


        {{-- Phone --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.phone') }}
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $customer->phone ?? '') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>


        {{-- Email --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.email') }}
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $customer->email ?? '') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>


        {{-- Status --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                {{ __('messages.status') }}
            </label>

            <select
                name="is_active"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <option value="1"
                    @selected(old('is_active', $customer->is_active ?? true) == 1)>

                    {{ __('messages.active') }}

                </option>

                <option value="0"
                    @selected(old('is_active', $customer->is_active ?? true) == 0)>

                    {{ __('messages.inactive') }}

                </option>

            </select>

            @error('is_active')
                <p class="mt-1 text-sm red-600">{{ $message }}</p>
            @enderror

        </div>

    </div>


    {{-- Address --}}
    <div class="mt-6">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.address') }}
        </label>

        <textarea
            rows="3"
            name="address"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', $customer->address ?? '') }}</textarea>

        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>


    {{-- Notes --}}
    <div class="mt-6">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.notes') }}
        </label>

        <textarea
            rows="4"
            name="notes"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $customer->notes ?? '') }}</textarea>

        @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>


    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('customers.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.cancel') }}

        </a>


        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

            {{ __('messages.save_customer') }}

        </button>

    </div>

</div>

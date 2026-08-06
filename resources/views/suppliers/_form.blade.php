@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <div>
        <label class="mb-2 block text-sm font-medium">
            {{ __('messages.supplier_name') }}
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $supplier->name ?? '') }}"
            class="w-full rounded-lg border-gray-300">

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium">
            {{ __('messages.phone') }}
        </label>

        <input
            type="text"
            name="phone"
            value="{{ old('phone', $supplier->phone ?? '') }}"
            class="w-full rounded-lg border-gray-300">

        @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium">
            {{ __('messages.email') }}
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $supplier->email ?? '') }}"
            class="w-full rounded-lg border-gray-300">

        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium">
            {{ __('messages.address') }}
        </label>

        <input
            type="text"
            name="address"
            value="{{ old('address', $supplier->address ?? '') }}"
            class="w-full rounded-lg border-gray-300">

        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium">
            {{ __('messages.notes') }}
        </label>

        <textarea
            rows="4"
            name="notes"
            class="w-full rounded-lg border-gray-300">{{ old('notes', $supplier->notes ?? '') }}</textarea>

        @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2 flex items-center gap-2">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $supplier->is_active ?? true))
            class="rounded border-gray-300">

        <label>{{ __('messages.active') }}</label>

    </div>

</div>

<div class="mt-6">
    <button
        class="rounded-lg bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700">

        {{ __('messages.save_supplier') }}

    </button>
</div>

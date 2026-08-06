@csrf

<div class="space-y-6">

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.name') }}
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $unit->name ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.symbol') }}
        </label>

        <input
            type="text"
            name="symbol"
            value="{{ old('symbol', $unit->symbol ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >

        @error('symbol')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-2">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $unit->is_active ?? true))
            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        >

        <label class="text-sm text-gray-700">
            {{ __('messages.active') }}
        </label>

    </div>

    <button
        type="submit"
        class="rounded-lg bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700">
        {{ __('messages.save') }}
    </button>

</div>

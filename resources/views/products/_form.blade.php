@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">

    {{-- Category --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.category') }}
        </label>

        <select
            name="category_id"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            <option value="">{{ __('messages.select_category') }}</option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $product->category_id ?? '') == $category->id)>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Brand --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.brand') }}
        </label>

        <select
            name="brand_id"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            <option value="">{{ __('messages.select_brand') }}</option>

            @foreach($brands as $brand)

                <option
                    value="{{ $brand->id }}"
                    @selected(old('brand_id', $product->brand_id ?? '') == $brand->id)>

                    {{ $brand->name }}

                </option>

            @endforeach

        </select>

        @error('brand_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Unit --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.unit') }}
        </label>

        <select
            name="unit_id"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            <option value="">{{ __('messages.select_unit') }}</option>

            @foreach($units as $unit)

                <option
                    value="{{ $unit->id }}"
                    @selected(old('unit_id', $product->unit_id ?? '') == $unit->id)>

                    {{ $unit->name }}

                </option>

            @endforeach

        </select>

        @error('unit_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Product Name --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.product_name') }}
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image --}}
    <div class="md:col-span-2">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.product_image') }}
        </label>

        <input
            type="file"
            name="image"
            class="block w-full rounded-lg border-gray-300">

        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @isset($product)
            @if($product->image)

                <img
                    src="{{ asset('storage/'.$product->image) }}"
                    class="mt-4 h-28 w-28 rounded-lg object-cover">

            @endif
        @endisset

    </div>

    {{-- Purchase Price --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.purchase_price') }}
        </label>

        <input
            type="number"
            step="0.01"
            name="purchase_price"
            value="{{ old('purchase_price', $product->purchase_price ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('purchase_price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Sale Price --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.sale_price') }}
        </label>

        <input
            type="number"
            step="0.01"
            name="sale_price"
            value="{{ old('sale_price', $product->sale_price ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('sale_price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Minimum Sale Price --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.minimum_sale_price') }}
        </label>

        <input
            type="number"
            step="0.01"
            name="minimum_sale_price"
            value="{{ old('minimum_sale_price', $product->minimum_sale_price ?? '') }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('minimum_sale_price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Quantity --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.quantity') }}
        </label>

        <input
            type="number"
            name="quantity"
            value="{{ old('quantity', $product->quantity ?? 0) }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('quantity')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Reorder Level --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.reorder_level') }}
        </label>

        <input
            type="number"
            name="reorder_level"
            value="{{ old('reorder_level', $product->reorder_level ?? 0) }}"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

        @error('reorder_level')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-gray-700">
            {{ __('messages.description') }}
        </label>

        <textarea
            rows="4"
            name="description"
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Active --}}
    <div class="md:col-span-2 flex items-center gap-2">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $product->is_active ?? true))
            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

        <label class="text-sm text-gray-700">
            {{ __('messages.active') }}
        </label>

    </div>

</div>

<div class="mt-8">
    <button
        type="submit"
        class="rounded-lg bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700">
        {{ __('messages.save_product') }}
    </button>
</div>

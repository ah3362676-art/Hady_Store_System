<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.products') }}
            </h1>

            <a href="{{ route('products.create') }}"
                class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                {{ __('messages.add_product') }}

            </a>

        </div>

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-3 text-left">{{ __('messages.image') }}</th>

                        <th class="px-4 py-3 text-left">{{ __('messages.name') }}</th>

                        <th class="px-4 py-3 text-left">{{ __('messages.category') }}</th>

                        <th class="px-4 py-3 text-left">{{ __('messages.brand') }}</th>

                        <th class="px-4 py-3 text-left">{{ __('messages.unit') }}</th>

                        <th class="px-4 py-3 text-center">
                            {{ __('messages.purchase_price') }}
                        </th>

                        <th class="px-4 py-3 text-center">
                            {{ __('messages.sale_price') }}
                        </th>

                        <th class="px-4 py-3 text-center">
                            {{ __('messages.quantity') }}
                        </th>

                        <th class="px-4 py-3 text-center">
                             {{ __('messages.expiry_date') }}
                        </th>

                        <th class="px-4 py-3 text-center">
                            {{ __('messages.status') }}
                        </th>

                        <th class="px-4 py-3 text-center">
                            {{ __('messages.actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($products as $product)

                        <tr>

                            <td class="px-4 py-3">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="h-14 w-14 rounded-lg object-cover">

                                @else

                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-lg bg-gray-100 text-sm">

                                        {{ __('messages.not_available') }}

                                    </div>

                                @endif

                            </td>

                            <td class="px-4 py-3 font-semibold">
                                {{ $product->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->category->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->brand->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->unit->name }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ number_format($product->purchase_price,2) }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ number_format($product->sale_price,2) }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $product->quantity }}
                            </td>
                            <td class="px-4 py-3 text-center">

    @if($product->nearest_expire_date)

        @php
            $days = now()->diffInDays(
                \Carbon\Carbon::parse($product->nearest_expire_date),
                false
            );
        @endphp

        @if($days <= 30)

            <span class="rounded bg-red-100 px-2 py-1 text-red-700">

                {{ \Carbon\Carbon::parse($product->nearest_expire_date)->format('Y-m-d') }}

            </span>

        @else

            <span class="rounded bg-green-100 px-2 py-1 text-green-700">

                {{ \Carbon\Carbon::parse($product->nearest_expire_date)->format('Y-m-d') }}

            </span>

        @endif

    @else

        <span class="text-gray-400">
            ---
        </span>

    @endif

</td>

                            <td class="px-4 py-3 text-center">

                                @if($product->is_active)

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                        {{ __('messages.active') }}
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm text-red-700">
                                        {{ __('messages.inactive') }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3 text-center">

                                <a
                                    href="{{ route('products.edit',$product) }}"
                                    class="mr-2 rounded bg-yellow-500 px-3 py-2 text-sm text-white hover:bg-yellow-600">

                                    {{ __('messages.edit') }}

                                </a>

                                <form
                                    action="{{ route('products.destroy',$product) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('{{ __('messages.delete_product_confirm') }}')"
                                        class="mr-2 rounded bg-red-500 px-3 py-2 text-sm text-white hover:bg-yellow-600">

                                        {{ __('messages.delete') }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="11"
                                class="py-6 text-center text-gray-500">

                                {{ __('messages.no_products_found') }}

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="border-t p-4">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</x-app-layout>

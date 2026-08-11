<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.sale_details') }}
            </h1>

            <a
                href="{{ route('sales.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">

                {{ __('messages.back') }}

            </a>

            <a
    href="{{ route('sales.pdf', $sale) }}"
    class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">

    🖨️ {{ __('messages.print_pdf') }}

</a>

        </div>

        <div class="rounded-xl bg-white shadow">

            <div class="border-b p-6">

                <h2 class="text-lg font-semibold">

                    {{ __('messages.invoice') }} #{{ $sale->invoice_number }}

                </h2>

            </div>

            <div class="grid grid-cols-2 gap-6 p-6">

                <div>

                    <strong>{{ __('messages.customer') }}:</strong>

                {{ $sale->customer?->name ?? __('messages.cash_customer') }}

                </div>

                <div>

                    <strong>{{ __('messages.date') }}:</strong>

                    {{ $sale->sale_date->format('Y-m-d') }}

                </div>

                <div>

                    <strong>{{ __('messages.payment_method') }}:</strong>

                    {{ ucfirst(str_replace('_',' ', $sale->payment_method)) }}

                </div>

                <div>

                    <strong>{{ __('messages.total') }}:</strong>

                    {{ number_format($sale->total,2) }}

                </div>

                <div>

                    <strong>{{ __('messages.paid') }}:</strong>

                    {{ number_format($sale->paid,2) }}

                </div>

                <div>

                    <strong>{{ __('messages.due') }}:</strong>

                    {{ number_format($sale->due,2) }}

                </div>

            </div>

            <div class="border-t">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                {{ __('messages.product') }}
                            </th>

                            <th class="px-4 py-3 text-center">
                                {{ __('messages.price') }}
                            </th>

                            <th class="px-4 py-3 text-center">
                                {{ __('messages.quantity') }}
                            </th>

                            <th class="px-4 py-3 text-center">
                                {{ __('messages.total') }}
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($sale->items as $item)

                            <tr class="border-t">

                                <td class="p-4">

                                    {{ $item->product->name }}

                                </td>

                                <td class="text-center">

                                    {{ number_format($item->sale_price,2) }}

                                </td>

                                <td class="text-center">

                                    {{ $item->quantity }}

                                </td>

                                <td class="text-center">

                                    {{ number_format($item->total,2) }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>

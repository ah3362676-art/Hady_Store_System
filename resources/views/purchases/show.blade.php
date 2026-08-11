```blade
<x-app-layout>

<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="mb-6 flex items-center justify-between">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.purchase_details') }}
        </h1>

        <a
            href="{{ route('purchases.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.back') }}

        </a>

    </div>

    <div class="rounded-xl bg-white p-6 shadow">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.invoice_number') }}
                </p>

                <p class="font-semibold">
                    {{ $purchase->invoice_number }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.supplier') }}
                </p>

                <p class="font-semibold">
                    {{ $purchase->supplier->name }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.date') }}
                </p>

                <p class="font-semibold">
                    {{ $purchase->purchase_date }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.payment_method') }}
                </p>

                <p class="font-semibold">
                    {{ $purchase->payment_method }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.paid') }}
                </p>

                <p class="font-semibold">
                    {{ number_format($purchase->paid, 2) }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    {{ __('messages.due') }}
                </p>

                <p class="font-semibold">
                    {{ number_format($purchase->due, 2) }}
                </p>

            </div>

        </div>

        @if($purchase->notes)

            <div class="mt-6">

                <p class="text-sm text-gray-500">
                    {{ __('messages.notes') }}
                </p>

                <p class="font-medium">
                    {{ $purchase->notes }}
                </p>

            </div>

        @endif

    </div>

    <div class="mt-8 overflow-hidden rounded-xl bg-white shadow">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-left">
                        {{ __('messages.product') }}
                    </th>

                    <th class="px-6 py-3 text-center">
                        {{ __('messages.purchase_price') }}
                    </th>

                    <th class="px-6 py-3 text-center">
                        {{ __('messages.quantity') }}
                    </th>

                    <th class="px-6 py-3 text-center">
                        {{ __('messages.expiry_date') }}
                    </th>

                    <th class="px-6 py-3 text-center">
                        {{ __('messages.total') }}
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach($purchase->items as $item)

                    <tr>

                        <td class="px-6 py-4">
                            {{ $item->product->name }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ number_format($item->purchase_price, 2) }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $item->quantity }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            @if($item->expiry_date)

                                @php
                                    $days = now()->diffInDays($item->expiry_date, false);
                                @endphp

                                @if($days < 0)

                                    <span class="rounded bg-red-100 px-2 py-1 text-sm font-semibold text-red-700">
                                        {{ $item->expiry_date->format('Y-m-d') }}
                                        (Expired)
                                    </span>

                                @elseif($days <= 30)

                                    <span class="rounded bg-yellow-100 px-2 py-1 text-sm font-semibold text-yellow-700">
                                        {{ $item->expiry_date->format('Y-m-d') }}
                                        ({{ $days }} days)
                                    </span>

                                @else

                                    <span class="rounded bg-green-100 px-2 py-1 text-sm font-semibold text-green-700">
                                        {{ $item->expiry_date->format('Y-m-d') }}
                                    </span>

                                @endif

                            @else

                                <span class="text-gray-400">
                                    —
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ number_format($item->total, 2) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="mt-6 rounded-xl bg-white p-6 shadow">

        <div class="ml-auto max-w-sm space-y-3">

            <div class="flex justify-between">

                <span>
                    {{ __('messages.subtotal') }}
                </span>

                <span>
                    {{ number_format($purchase->subtotal, 2) }}
                </span>

            </div>

            <div class="flex justify-between">

                <span>
                    {{ __('messages.discount') }}
                </span>

                <span>
                    {{ number_format($purchase->discount, 2) }}
                </span>

            </div>

            <div class="flex justify-between font-bold">

                <span>
                    {{ __('messages.total') }}
                </span>

                <span>
                    {{ number_format($purchase->total, 2) }}
                </span>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
```

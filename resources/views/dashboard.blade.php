<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('messages.dashboard') }}
        </h2>

    </x-slot>


    <div class="py-6">

        <div class="mx-auto max-w-7xl px-4">


            {{-- Main Statistics --}}

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">


                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.products') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $productsCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            📦
                        </div>

                    </div>

                </div>




                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.categories') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $categoriesCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            🗂️
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.brands') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $brandsCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            🏷️
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.customers') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $customersCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            👥
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.suppliers') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $suppliersCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            🚚
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.purchases') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $purchasesCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            📥
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-white p-6 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                {{ __('messages.sales') }}
                            </p>

                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $salesCount }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            🛒
                        </div>

                    </div>

                </div>





                <div class="rounded-xl bg-indigo-600 p-6 text-white shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-indigo-100 text-sm">
                                {{ __('messages.welcome') }}
                            </p>

                            <h3 class="mt-2 text-2xl font-bold">
                                {{ Auth::user()->name }}
                            </h3>

                        </div>

                        <div class="text-5xl">
                            👋
                        </div>

                    </div>

                </div>


            </div>
                        {{-- Financial Statistics --}}

            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">


                <div class="rounded-xl bg-green-600 p-6 text-white shadow">

                    <p class="text-green-100">
                        {{ __('messages.total_sales') }}
                    </p>

                    <h3 class="mt-2 text-3xl font-bold">

                        {{ number_format($salesTotal,2) }}

                    </h3>

                </div>




                <div class="rounded-xl bg-blue-600 p-6 text-white shadow">

                    <p class="text-blue-100">
                        {{ __('messages.total_purchases') }}
                    </p>

                    <h3 class="mt-2 text-3xl font-bold">

                        {{ number_format($purchasesTotal,2) }}

                    </h3>

                </div>




                <div class="rounded-xl bg-yellow-500 p-6 text-white shadow">

                    <p class="text-yellow-100">
                        {{ __('messages.profit') }}
                    </p>

                    <h3 class="mt-2 text-3xl font-bold">

                        {{ number_format($profit,2) }}

                    </h3>

                </div>




                <div class="rounded-xl bg-red-600 p-6 text-white shadow">

                    <p class="text-red-100">
                        {{ __('messages.due') }}
                    </p>

                    <p class="mt-2">

                        {{ __('messages.customers') }}:
                        {{ number_format($customerDue,2) }}

                    </p>

                    <p>

                        {{ __('messages.suppliers') }}:
                        {{ number_format($supplierDue,2) }}

                    </p>

                </div>



            </div>





            {{-- Tables --}}

            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">


                {{-- Low Stock Products --}}

                <div class="rounded-xl bg-white shadow">


                    <div class="border-b px-6 py-4">

                        <h2 class="text-lg font-bold text-gray-800">

                            {{ __('messages.low_stock_products') }}

                        </h2>

                    </div>



                    <div class="p-6">

                        <table class="w-full">

                            <thead>

                                <tr class="text-left text-sm text-gray-500">

                                    <th>
                                        {{ __('messages.product') }}
                                    </th>

                                    <th class="text-center">
                                        {{ __('messages.quantity') }}
                                    </th>

                                </tr>

                            </thead>



                            <tbody>

                                @forelse($lowStockProducts as $product)

                                    <tr class="border-t">

                                        <td class="py-3">

                                            {{ $product->name }}

                                        </td>


                                        <td class="text-center">

                                            <span class="rounded bg-red-100 px-3 py-1 text-red-700">

                                                {{ $product->quantity }}

                                            </span>

                                        </td>


                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="2"
                                            class="py-5 text-center text-gray-500">

                                            {{ __('messages.no_low_stock_products') }}

                                        </td>

                                    </tr>

                                @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>





                {{-- Latest Sales --}}

                <div class="rounded-xl bg-white shadow">


                    <div class="border-b px-6 py-4">

                        <h2 class="text-lg font-bold text-gray-800">

                            {{ __('messages.latest_sales') }}

                        </h2>

                    </div>



                    <div class="p-6">

                        <table class="w-full">


                            <thead>

                                <tr class="text-left text-sm text-gray-500">

                                    <th>
                                        {{ __('messages.invoice') }}
                                    </th>

                                    <th>
                                        {{ __('messages.total') }}
                                    </th>

                                </tr>

                            </thead>



                            <tbody>


                                @forelse($latestSales as $sale)


                                    <tr class="border-t">


                                        <td class="py-3">

                                            {{ $sale->invoice_number }}

                                        </td>


                                        <td>

                                            {{ number_format($sale->total,2) }}

                                        </td>


                                    </tr>


                                @empty


                                    <tr>

                                        <td colspan="2"
                                            class="py-5 text-center text-gray-500">

                                            {{ __('messages.no_sales') }}

                                        </td>

                                    </tr>


                                @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>






                {{-- Latest Purchases --}}

                <div class="rounded-xl bg-white shadow">


                    <div class="border-b px-6 py-4">

                        <h2 class="text-lg font-bold text-gray-800">

                            {{ __('messages.latest_purchases') }}

                        </h2>

                    </div>



                    <div class="p-6">


                        <table class="w-full">


                            <thead>

                                <tr class="text-left text-sm text-gray-500">

                                    <th>
                                        {{ __('messages.invoice') }}
                                    </th>

                                    <th>
                                        {{ __('messages.total') }}
                                    </th>

                                </tr>

                            </thead>



                            <tbody>


                                @forelse($latestPurchases as $purchase)


                                    <tr class="border-t">


                                        <td class="py-3">

                                            {{ $purchase->invoice_number }}

                                        </td>



                                        <td>

                                            {{ number_format($purchase->total,2) }}

                                        </td>


                                    </tr>


                                @empty


                                    <tr>

                                        <td colspan="2"
                                            class="py-5 text-center text-gray-500">

                                            {{ __('messages.no_purchases') }}

                                        </td>

                                    </tr>


                                @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>


            </div>
                        {{-- Top Selling Products --}}

            <div class="mt-8 rounded-xl bg-white shadow">


                <div class="border-b px-6 py-4">

                    <h2 class="text-lg font-bold text-gray-800">

                        {{ __('messages.top_selling_products') }}

                    </h2>

                </div>


                <div class="p-6">

                    <table class="w-full">


                        <thead>

                            <tr class="text-left text-sm text-gray-500">

                                <th class="pb-3">

                                    {{ __('messages.product') }}

                                </th>


                                <th class="pb-3">

                                    {{ __('messages.sold_quantity') }}

                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($topProducts as $item)


                                <tr class="border-t">


                                    <td class="py-3">

                                        {{ $item->product?->name ?? __('messages.deleted_product') }}

                                    </td>



                                    <td>

                                        <span class="rounded bg-indigo-100 px-3 py-1 text-indigo-700">

                                            {{ $item->total_quantity }}

                                        </span>

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="2"
                                        class="py-5 text-center text-gray-500">

                                        {{ __('messages.no_data') }}

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>


                </div>


            </div>

            <div class="mt-8 rounded-xl bg-white shadow">

    <div class="border-b px-6 py-4">

        <h2 class="text-lg font-bold text-red-600">

    {{ __('messages.expiring_products') }}

        </h2>

    </div>

    <div class="p-6">

        <table class="w-full">

            <thead>

                <tr class="text-left text-gray-500">
                <th>{{ __('messages.product') }}</th>
                <th>{{ __('messages.expiry_date') }}</th>
                <th>{{ __('messages.remaining') }}</th>

                </tr>

            </thead>

            <tbody>

            @forelse($expiringProducts as $product)

@php

$expire = \Carbon\Carbon::parse(
    $product->purchaseItems->first()->expiry_date
);

$days = Carbon\Carbon::now()
    ->startOfDay()
    ->diffInDays(
        $expire->copy()->startOfDay()
    );
@endphp

                <tr class="border-t">

                    <td class="py-3">

                        {{ $product->name }}

                    </td>

                    <td>

                        {{ $expire->format('Y-m-d') }}

                    </td>

                    <td>

                        @if($days <= 7)

                            <span class="rounded bg-red-100 px-3 py-1 text-red-700">

                        {{ $days }} {{ __('messages.days') }}
                            </span>

                        @elseif($days <= 15)

                            <span class="rounded bg-yellow-100 px-3 py-1 text-yellow-700">

                        {{ $days }} {{ __('messages.days') }}

                            </span>

                        @else

                            <span class="rounded bg-green-100 px-3 py-1 text-green-700">

                        {{ $days }} {{ __('messages.days') }}

                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="py-5 text-center text-gray-500">

                {{ __('messages.no_expiring_products') }}
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>




            {{-- Charts --}}


            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">


                <div class="rounded-xl bg-white p-6 shadow">


                    <h2 class="mb-5 text-lg font-bold">

                        {{ __('messages.sales_last_7_days') }}

                    </h2>


                    <canvas id="salesChart"></canvas>


                </div>





                <div class="rounded-xl bg-white p-6 shadow">


                    <h2 class="mb-5 text-lg font-bold">

                        {{ __('messages.purchases_last_7_days') }}

                    </h2>


                    <canvas id="purchasesChart"></canvas>


                </div>



            </div>


        </div>


    </div>






@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


const salesData = @json($salesChart);


const purchasesData = @json($purchasesChart);





new Chart(document.getElementById('salesChart'), {


    type: 'line',


    data: {


        labels: salesData.map(item => item.date),


        datasets: [{


            label: "{{ __('messages.sales') }}",


            data: salesData.map(item => item.total),


            borderWidth: 3


        }]


    },


    options: {


        responsive: true

    }


});







new Chart(document.getElementById('purchasesChart'), {


    type: 'line',


    data: {


        labels: purchasesData.map(item => item.date),


        datasets: [{


            label: "{{ __('messages.purchases') }}",


            data: purchasesData.map(item => item.total),


            borderWidth: 3


        }]


    },


    options: {


        responsive: true

    }


});



</script>


@endpush




</x-app-layout>

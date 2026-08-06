<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.sales') }}
            </h1>

            <a
                href="{{ route('sales.create') }}"
                class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                + {{ __('messages.new_sale') }}

            </a>

        </div>

        @if(session('success'))

            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">

                {{ session('success') }}

            </div>

        @endif
        <div class="mb-6 rounded-xl bg-white p-6 shadow">

    <form
        action="{{ route('sales.index') }}"
        method="GET">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6">

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    From Date
                </label>

                <input
                    type="date"
                    name="from_date"
                    value="{{ request('from_date') }}"
                    class="w-full rounded-lg border-gray-300">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    To Date
                </label>

                <input
                    type="date"
                    name="to_date"
                    value="{{ request('to_date') }}"
                    class="w-full rounded-lg border-gray-300">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Invoice
                </label>

                <input
                    type="text"
                    name="invoice_number"
                    value="{{ request('invoice_number') }}"
                    placeholder="SAL000001"
                    class="w-full rounded-lg border-gray-300">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Customer
                </label>

                <input
                    type="text"
                    name="customer"
                    value="{{ request('customer') }}"
                    placeholder="Customer Name"
                    class="w-full rounded-lg border-gray-300">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Payment
                </label>

                <select
                    name="payment_method"
                    class="w-full rounded-lg border-gray-300">

                    <option value="">
                        All
                    </option>

                    <option
                        value="Cash"
                        @selected(request('payment_method') == 'Cash')>
                        Cash
                    </option>

                    <option
                        value="Vodafone Cash"
                        @selected(request('payment_method') == 'Vodafone Cash')>
                        Vodafone Cash
                    </option>

                </select>

            </div>

            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                    Search

                </button>

                <a
                    href="{{ route('sales.index') }}"
                    class="rounded-lg bg-gray-500 px-5 py-2 text-white hover:bg-gray-600">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.invoice') }}
                        </th>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.customer') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.date') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.total') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.paid') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.due') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($sales as $sale)

                        <tr>

                            <td class="px-6 py-4">

                                {{ $sale->invoice_number }}

                            </td>

                            <td class="px-6 py-4">

                {{ $sale->customer?->name ?? __('messages.cash_customer') }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $sale->sale_date->format('Y-m-d') }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ number_format($sale->total,2) }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ number_format($sale->paid,2) }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($sale->due > 0)

                                    <span class="font-semibold text-red-600">

                                        {{ number_format($sale->due,2) }}

                                    </span>

                                @else

                                    <span class="font-semibold text-green-600">

                                        0.00

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a
                                        href="{{ route('sales.show',$sale) }}"
                                        class="rounded bg-blue-600 px-3 py-2 text-white hover:bg-blue-700">

                                        {{ __('messages.show') }}

                                    </a>

                                    <a
                                        href="{{ route('sales.edit',$sale) }}"
                                        class="rounded bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">

                                        {{ __('messages.edit') }}

                                    </a>

                                    <form
                                        action="{{ route('sales.destroy',$sale) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('messages.delete_sale_confirm') }}')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded bg-red-600 px-3 py-2 text-white hover:bg-red-700">

                                            {{ __('messages.delete') }}

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-8 text-center text-gray-500">

                                {{ __('messages.no_sales_found') }}

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $sales->links() }}

        </div>

    </div>

</x-app-layout>

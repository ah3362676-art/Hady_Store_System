<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold">
                {{ __('messages.reports') }}
            </h1>

        </div>

        <form
            method="GET"
            class="mb-6 rounded-xl bg-white p-6 shadow">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <input
                    type="date"
                    name="from_date"
                    value="{{ request('from_date') }}"
                    class="rounded-lg border-gray-300">

                <input
                    type="date"
                    name="to_date"
                    value="{{ request('to_date') }}"
                    class="rounded-lg border-gray-300">

                <button
                    type="submit"
                    class="rounded-lg bg-indigo-600 py-2 text-white hover:bg-indigo-700">

                    {{ __('messages.filter') }}

                </button>

            </div>

        </form>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5">

            <div class="rounded-xl bg-white p-6 shadow">

                <p class="text-gray-500">
                    {{ __('messages.sales') }}
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    {{ number_format($summary['salesTotal'], 2) }}
                </h2>

            </div>

            <div class="rounded-xl bg-white p-6 shadow">

                <p class="text-gray-500">
                    {{ __('messages.purchases') }}
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    {{ number_format($summary['purchasesTotal'], 2) }}
                </h2>

            </div>

            <div class="rounded-xl bg-white p-6 shadow">

                <p class="text-gray-500">
                    {{ __('messages.profit') }}
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    {{ number_format($summary['profit'], 2) }}
                </h2>

            </div>

            <div class="rounded-xl bg-white p-6 shadow">

                <p class="text-gray-500">
                    {{ __('messages.customer_due') }}
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-600">
                    {{ number_format($summary['customerDue'], 2) }}
                </h2>

            </div>

            <div class="rounded-xl bg-white p-6 shadow">

                <p class="text-gray-500">
                    {{ __('messages.supplier_due') }}
                </p>

                <h2 class="mt-2 text-3xl font-bold text-orange-600">
                    {{ number_format($summary['supplierDue'], 2) }}
                </h2>

            </div>

        </div>

    </div>

</x-app-layout>

<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ __('messages.customer_statement') }}
                </h1>

                <p class="mt-1 text-gray-500">
                    {{ $customer->name }}
                </p>

            </div>

            <a
                href="{{ route('customers.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">

                {{ __('messages.back') }}

            </a>

        </div>

        {{-- Customer Info --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <div>

                    <p class="text-sm text-gray-500">
                        {{ __('messages.customer') }}
                    </p>

                    <h2 class="mt-2 text-xl font-bold">
                        {{ $customer->name }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        {{ __('messages.phone') }}
                    </p>

                    <h2 class="mt-2 text-xl font-bold">
                        {{ $customer->phone }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        {{ __('messages.current_balance') }}
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-red-600">
                        {{ number_format($customer->balance, 2) }}
                    </h2>

                </div>

            </div>

        </div>

        {{-- Filter --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow">

            <form
                action="{{ route('customers.statement', $customer) }}"
                method="GET">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            {{ __('messages.from_date') }}
                        </label>

                        <input
                            type="date"
                            name="from_date"
                            value="{{ request('from_date') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            {{ __('messages.to_date') }}
                        </label>

                        <input
                            type="date"
                            name="to_date"
                            value="{{ request('to_date') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                            {{ __('messages.filter') }}

                        </button>

                        <a
                            href="{{ route('customers.statement', $customer) }}"
                            class="rounded-lg bg-gray-500 px-5 py-2 text-white hover:bg-gray-600">

                            {{ __('messages.reset') }}

                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- Statement --}}
        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.date') }}
                        </th>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.type') }}
                        </th>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.number') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.debit') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.credit') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.balance') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($statement as $row)

                        <tr>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($row['date'])->format('Y-m-d') }}
                            </td>

                            <td class="px-6 py-4">

                                @if($row['type'] == 'Sale')

                                    <span class="rounded bg-green-100 px-3 py-1 text-green-700">
                                        {{ __('messages.sale') }}
                                    </span>

                                @else

                                    <span class="rounded bg-blue-100 px-3 py-1 text-blue-700">
                                        {{ __('messages.payment') }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $row['number'] }}
                            </td>

                            <td class="px-6 py-4 text-center font-semibold text-red-600">
                                {{ number_format($row['debit'], 2) }}
                            </td>

                            <td class="px-6 py-4 text-center font-semibold text-green-600">
                                {{ number_format($row['credit'], 2) }}
                            </td>

                            <td class="px-6 py-4 text-center font-bold">
                                {{ number_format($row['balance'], 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-gray-500">

                                {{ __('messages.no_transactions_found') }}

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>

<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.supplier_payments') }}
            </h1>

            <a
                href="{{ route('supplier-payments.create') }}"
                class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                + {{ __('messages.new_payment') }}

            </a>

        </div>

        @if(session('success'))

            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">

                {{ session('success') }}

            </div>

        @endif

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.receipt') }}
                        </th>

                        <th class="px-6 py-3 text-left">
                            {{ __('messages.supplier') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.date') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.amount') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.payment_method') }}
                        </th>

                        <th class="px-6 py-3 text-center">
                            {{ __('messages.actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($supplierPayments as $payment)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $payment->receipt_number }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $payment->supplier->name }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ number_format($payment->amount, 2) }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a
                                        href="{{ route('supplier-payments.edit', $payment) }}"
                                        class="rounded bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">

                                        {{ __('messages.edit') }}

                                    </a>

                                    <form
                                        action="{{ route('supplier-payments.destroy', $payment) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('messages.delete_payment_confirm') }}')">

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
                                colspan="6"
                                class="px-6 py-8 text-center text-gray-500">

                                {{ __('messages.no_supplier_payments_found') }}

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $supplierPayments->links() }}

        </div>

    </div>

</x-app-layout>

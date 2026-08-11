<x-app-layout>

<div class="max-w-7xl mx-auto px-4 py-6">

    @if(session('success'))

        <div class="mb-5 rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>

    @endif

    <div class="mb-6 flex items-center justify-between">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.purchases') }}
        </h1>

        <a
            href="{{ route('purchases.create') }}"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

            + {{ __('messages.new_purchase') }}

        </a>

    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.invoice') }}
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.supplier') }}
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.date') }}
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.total') }}
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.paid') }}
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            {{ __('messages.due') }}
                        </th>

                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">
                            {{ __('messages.actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                @forelse($purchases as $purchase)

                    <tr>

                        <td class="px-6 py-4">
                            {{ $purchase->invoice_number }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $purchase->supplier->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $purchase->purchase_date }}
                        </td>

                        <td class="px-6 py-4">
                            {{ number_format($purchase->total,2) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ number_format($purchase->paid,2) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ number_format($purchase->due,2) }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('purchases.show',$purchase) }}"
                                    class="rounded bg-blue-600 px-3 py-1 text-sm text-white">

                                    {{ __('messages.view') }}

                                </a>

                                <a
                                    href="{{ route('purchases.edit',$purchase) }}"
                                    class="rounded bg-yellow-500 px-3 py-1 text-sm text-white">

                                    {{ __('messages.edit') }}

                                </a>

                                <form
                                    action="{{ route('purchases.destroy',$purchase) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('{{ __('messages.delete_purchase_confirm') }}')"
                                        class="rounded bg-red-600 px-3 py-1 text-sm text-white">

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
                            class="px-6 py-6 text-center text-gray-500">

                            {{ __('messages.no_purchases_found') }}

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-5">

        {{ $purchases->links() }}

    </div>

</div>

</x-app-layout>

<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.suppliers') }}
            </h1>

            <a href="{{ route('suppliers.create') }}"
               class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">
                {{ __('messages.add_supplier') }}
            </a>

        </div>

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">{{ __('messages.name') }}</th>
                        <th class="px-4 py-3 text-left">{{ __('messages.phone') }}</th>
                        <th class="px-4 py-3 text-left">{{ __('messages.email') }}</th>
                        <th class="px-4 py-3 text-left">{{ __('messages.balance') }}</th>
                        <th class="px-4 py-3 text-center">{{ __('messages.status') }}</th>
                        <th class="px-4 py-3 text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($suppliers as $supplier)

                        <tr>

                            <td class="px-4 py-3">{{ $supplier->name }}</td>

                            <td class="px-4 py-3">{{ $supplier->phone }}</td>

                            <td class="px-4 py-3">
                                {{ $supplier->email ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ number_format($supplier->balance,2) }}
                            </td>

                            <td class="px-4 py-3 text-center">

                                @if($supplier->is_active)

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

                                <a href="{{ route('suppliers.edit',$supplier) }}"
                                   class="mr-2 rounded bg-yellow-500 px-3 py-2 text-sm text-white hover:bg-yellow-600">

                                    {{ __('messages.edit') }}

                                </a>

                                <form
                                    action="{{ route('suppliers.destroy',$supplier) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('{{ __('messages.delete_supplier_confirm') }}')"
                                        class="rounded bg-red-600 px-3 py-2 text-white">

                                        {{ __('messages.delete') }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-6 text-center">

                                {{ __('messages.no_suppliers_found') }}

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="border-t p-4">

                {{ $suppliers->links() }}

            </div>

        </div>

    </div>

</x-app-layout>

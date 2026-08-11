<x-app-layout>

<div class="max-w-7xl mx-auto px-4 py-6">

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.units') }}
        </h1>

        <a href="{{ route('units.create') }}"
            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">
            {{ __('messages.add_unit') }}
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.name') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.status') }}</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">
                        {{ __('messages.actions') }}
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">

                @forelse($units as $unit)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $unit->name }}
                        </td>

                        <td class="px-6 py-4">
                            @if($unit->is_active)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                    {{ __('messages.active') }}
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-sm text-red-700">
                                    {{ __('messages.inactive') }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">

                            <a href="{{ route('units.edit', $unit) }}"
                               class="mr-2 rounded bg-yellow-500 px-3 py-2 text-sm text-white hover:bg-yellow-600">
                                {{ __('messages.edit') }}
                            </a>

                            <form action="{{ route('units.destroy', $unit) }}"
                                  method="POST"
                                  class="inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('{{ __('messages.delete_unit_confirm') }}')"
                                    class="rounded bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                                    {{ __('messages.delete') }}
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                            {{ __('messages.no_units_found') }}
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
</x-app-layout>

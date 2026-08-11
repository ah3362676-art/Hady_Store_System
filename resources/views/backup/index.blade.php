<x-app-layout>
{{-- Header --}}
<div class="mb-6 flex items-center justify-between">

    <div>

        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.Backup') }}
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('messages.backup_description') }}
        </p>

    </div>


    {{-- Create Backup --}}
    <form
        method="POST"
        action="{{ route('backup.run') }}"
    >

        @csrf

        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700"
        >
            {{ __('messages.create_backup') }}
        </button>

    </form>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="mb-6 rounded-lg border border-green-200 bg-green-100 p-4 text-green-700">
        {{ session('success') }}
    </div>

@endif


{{-- Error Message --}}
@if(session('error'))

    <div class="mb-6 whitespace-pre-line rounded-lg border border-red-200 bg-red-100 p-4 text-red-700">
        {{ session('error') }}
    </div>

@endif


{{-- Backup History --}}
<div class="overflow-hidden rounded-xl bg-white shadow">

    <div class="border-b border-gray-200 px-6 py-4">

        <h2 class="text-lg font-semibold text-gray-800">
            {{ __('messages.backup_history') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('messages.all_available_backups') }}
        </p>

    </div>


    @if($backups->count())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            #
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            {{ __('messages.file_name') }}
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            {{ __('messages.size') }}
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            {{ __('messages.created_at') }}
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            {{ __('messages.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @foreach($backups as $index => $backup)

                        <tr class="hover:bg-gray-50">

                            {{-- Number --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $index + 1 }}
                            </td>


                            {{-- File Name --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center">

                                    <div class="mr-3 rounded-lg bg-indigo-100 p-2">
                                        📦
                                    </div>

                                    <div>

                                        <p class="max-w-md truncate font-medium text-gray-800">
                                            {{ $backup['name'] }}
                                        </p>

                                        @if($index === 0)

                                            <span class="mt-1 inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                                {{ __('messages.latest') }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Size --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                @if($backup['size'] >= 1024 * 1024)

                                    {{ number_format($backup['size'] / 1024 / 1024, 2) }} MB

                                @else

                                    {{ number_format($backup['size'] / 1024, 2) }} KB

                                @endif

                            </td>


                            {{-- Created At --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                {{ \Carbon\Carbon::createFromTimestamp($backup['created_at'])->format('Y-m-d h:i A') }}

                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- Download --}}
                                    <a
                                        href="{{ route('backup.download', ['filename' => $backup['name']]) }}"
                                        class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200"
                                    >
                                        {{ __('messages.download') }}
                                    </a>

                                    {{-- Restore --}}
                                    <form
                                        method="POST"
                                        action="{{ route('backup.restore', ['filename' => $backup['name']]) }}"
                                        onsubmit="return confirm('{{ __('messages.confirm_restore_backup') }}');"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-amber-100 px-3 py-2 text-sm font-medium text-amber-700 transition hover:bg-amber-200"
                                        >
                                            {{ __('messages.restore') }}
                                        </button>
                                    </form>





                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('backup.destroy', ['filename' => $backup['name']]) }}"
                                        onsubmit="return confirm('{{ __('messages.confirm_delete_backup') }}');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 transition hover:bg-red-200"
                                        >
                                            {{ __('messages.delete') }}
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        {{-- No Backups --}}
        <div class="px-6 py-12 text-center">

            <div class="text-5xl">
                📦
            </div>

            <h3 class="mt-4 text-lg font-semibold text-gray-800">
                {{ __('messages.no_backups_found') }}
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                {{ __('messages.create_first_backup') }}
            </p>

        </div>

    @endif

</div>



</x-app-layout>


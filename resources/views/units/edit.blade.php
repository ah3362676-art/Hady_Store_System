<x-app-layout>

<div class="max-w-4xl mx-auto px-4 py-6">

    <div class="mb-6 flex items-center justify-between">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.edit_unit') }}
        </h1>

        <a href="{{ route('units.index') }}"
           class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">
            {{ __('messages.back') }}
        </a>

    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow">

        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold">
                {{ __('messages.update_unit') }}
            </h2>
        </div>

        <div class="p-6">

            <form action="{{ route('units.update', $unit) }}" method="POST">

                @csrf
                @method('PUT')

                @include('units._form')

            </form>

        </div>

    </div>

</div>

</x-app-layout>

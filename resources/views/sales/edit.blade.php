<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.edit_sale') }}
            </h1>

            <a
                href="{{ route('sales.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">

                {{ __('messages.back') }}

            </a>

        </div>

        <form
            action="{{ route('sales.update', $sale) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('sales._form')

        </form>

    </div>

</x-app-layout>

<x-app-layout>

<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="mb-6 flex items-center justify-between">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.edit_purchase') }}
        </h1>

        <a
            href="{{ route('purchases.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-100">

            {{ __('messages.back') }}

        </a>

    </div>

    <form
        action="{{ route('purchases.update', $purchase) }}"
        method="POST">

        @csrf
        @method('PUT')

        @include('purchases._form')

    </form>

</div>

</x-app-layout>

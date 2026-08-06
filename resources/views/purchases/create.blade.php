<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <h1 class="mb-6 text-3xl font-bold">
            {{ __('messages.new_purchase_invoice') }}
        </h1>

        <form
            action="{{ route('purchases.store') }}"
            method="POST">

            @csrf

            @include('purchases._form')

        </form>

    </div>

</x-app-layout>

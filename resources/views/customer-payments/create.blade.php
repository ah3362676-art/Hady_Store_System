<x-app-layout>

    <div class="max-w-4xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.create_customer_payment') }}
            </h1>

            <a
                href="{{ route('customer-payments.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">

                {{ __('messages.back') }}

            </a>

        </div>

        <form
            action="{{ route('customer-payments.store') }}"
            method="POST">

            @csrf

            @include('customer-payments._form')

        </form>

    </div>

</x-app-layout>

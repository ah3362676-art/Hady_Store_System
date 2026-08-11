<x-app-layout>

    <div class="max-w-4xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold">
                {{ __('messages.create_supplier_payment') }}
            </h1>

            <a
                href="{{ route('supplier-payments.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2 text-white">

                {{ __('messages.back') }}

            </a>

        </div>

        <form
            action="{{ route('supplier-payments.store') }}"
            method="POST">

            @csrf

            @include('supplier-payments._form')

        </form>

    </div>

</x-app-layout>

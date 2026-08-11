<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('messages.edit_customer') }}
        </h2>

    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-5xl px-6">

            <form
                action="{{ route('customers.update', $customer) }}"
                method="POST">

                @csrf
                @method('PUT')

                @include('customers._form')

            </form>

        </div>

    </div>

</x-app-layout>

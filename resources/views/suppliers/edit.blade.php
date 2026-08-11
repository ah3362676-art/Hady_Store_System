<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold">
                {{ __('messages.edit_supplier') }}
            </h1>

            <a href="{{ route('suppliers.index') }}"
               class="rounded-lg bg-gray-500 px-5 py-2 text-white">

                {{ __('messages.back') }}

            </a>

        </div>

        <div class="rounded-xl bg-white p-6 shadow">

            <form
                action="{{ route('suppliers.update',$supplier) }}"
                method="POST">

                @csrf
                @method('PUT')

                @include('suppliers._form')

            </form>

        </div>

    </div>

</x-app-layout>

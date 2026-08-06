<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="mb-6 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('messages.edit_product') }}
            </h1>

            <a
                href="{{ route('products.index') }}"
                class="rounded-lg bg-gray-500 px-5 py-2 text-white hover:bg-gray-600">

                {{ __('messages.back') }}

            </a>

        </div>

        <div class="rounded-xl bg-white p-6 shadow">

            <form
                action="{{ route('products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('products._form')

            </form>

        </div>

    </div>

</x-app-layout>

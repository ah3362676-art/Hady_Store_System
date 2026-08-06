<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('messages.customer_details') }}
        </h2>

    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-4xl px-6">

            <div class="rounded-xl bg-white p-6 shadow">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>
                        <h3 class="text-sm text-gray-500">{{ __('messages.name') }}</h3>
                        <p class="font-medium">{{ $customer->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm text-gray-500">{{ __('messages.phone') }}</h3>
                        <p class="font-medium">{{ $customer->phone }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm text-gray-500">{{ __('messages.email') }}</h3>
                        <p class="font-medium">
                            {{ $customer->email ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm text-gray-500">{{ __('messages.balance') }}</h3>
                        <p class="font-medium">
                            {{ number_format($customer->balance, 2) }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-sm text-gray-500">{{ __('messages.address') }}</h3>
                        <p>{{ $customer->address ?: '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-sm text-gray-500">{{ __('messages.notes') }}</h3>
                        <p>{{ $customer->notes ?: '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm text-gray-500">{{ __('messages.status') }}</h3>

                        @if($customer->is_active)
                            <span class="rounded bg-green-100 px-3 py-1 text-green-700">
                                {{ __('messages.active') }}
                            </span>
                        @else
                            <span class="rounded bg-red-100 px-3 py-1 text-red-700">
                                {{ __('messages.inactive') }}
                            </span>
                        @endif

                    </div>

                </div>

                <div class="mt-8">

                    <a
                        href="{{ route('customers.index') }}"
                        class="rounded-lg border px-5 py-2">

                        {{ __('messages.back') }}

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

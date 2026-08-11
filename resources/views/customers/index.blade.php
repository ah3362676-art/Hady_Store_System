<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('messages.customers') }}
            </h2>

            <a
                href="{{ route('customers.create') }}"
                class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">

                + {{ __('messages.add_customer') }}

            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-7xl px-6">


            @if(session('success'))

                <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">

                    {{ session('success') }}

                </div>

            @endif



            <div class="overflow-hidden rounded-xl bg-white shadow">


                <table class="min-w-full divide-y divide-gray-200">


                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-6 py-3 text-left">
                                {{ __('messages.name') }}
                            </th>

                            <th class="px-6 py-3 text-left">
                                {{ __('messages.phone') }}
                            </th>

                            <th class="px-6 py-3 text-left">
                                {{ __('messages.balance') }}
                            </th>

                            <th class="px-6 py-3 text-left">
                                {{ __('messages.status') }}
                            </th>

                            <th class="px-6 py-3 text-center">
                                {{ __('messages.actions') }}
                            </th>

                        </tr>

                    </thead>



                    <tbody class="divide-y divide-gray-200 bg-white">


                        @forelse($customers as $customer)


                            <tr>


                                <td class="px-6 py-4">

                                    {{ $customer->name }}

                                </td>


                                <td class="px-6 py-4">

                                    {{ $customer->phone }}

                                </td>



                                <td class="px-6 py-4">


                                    @if($customer->balance > 0)


                                        <span class="font-semibold text-red-600">

                                            {{ number_format($customer->balance, 2) }}

                                        </span>


                                    @else


                                        <span class="font-semibold text-green-600">

                                            0.00

                                        </span>


                                    @endif


                                </td>




                                <td class="px-6 py-4">


                                    @if($customer->is_active)


                                        <span class="rounded bg-green-100 px-3 py-1 text-sm text-green-700">

                                            {{ __('messages.active') }}

                                        </span>


                                    @else


                                        <span class="rounded bg-red-100 px-3 py-1 text-sm text-red-700">

                                            {{ __('messages.inactive') }}

                                        </span>


                                    @endif


                                </td>





                                <td class="px-6 py-4">


                                    <div class="flex justify-center gap-2">


                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            class="rounded bg-blue-600 px-3 py-2 text-white hover:bg-blue-700">

                                            {{ __('messages.show') }}

                                        </a>



                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            class="rounded bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">

                                            {{ __('messages.edit') }}

                                        </a>

                                        <a
                                        href="{{ route('customers.statement', $customer) }}"
                                        class="rounded bg-indigo-600 px-3 py-2 text-white hover:bg-indigo-700">

                                            {{ __('messages.Statement') }}

                                        </a>




                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('messages.are_you_sure') }}')">


                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="rounded bg-red-600 px-3 py-2 text-white hover:bg-red-700">


                                                {{ __('messages.delete') }}


                                            </button>


                                        </form>



                                    </div>


                                </td>



                            </tr>



                        @empty



                            <tr>


                                <td
                                    colspan="5"
                                    class="px-6 py-8 text-center text-gray-500">


                                    {{ __('messages.no_customers_found') }}


                                </td>


                            </tr>



                        @endforelse



                    </tbody>



                </table>



            </div>




            <div class="mt-6">

                {{ $customers->links() }}

            </div>



        </div>


    </div>


</x-app-layout>

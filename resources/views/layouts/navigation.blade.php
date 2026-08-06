<nav class="bg-white border-b border-gray-200">

    <div class="flex items-center justify-between h-16 px-6">

        {{-- Sidebar Toggle --}}
        <button
            @click="open = !open"
            class="text-gray-700 transition hover:text-indigo-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />

            </svg>

        </button>


        <div class="flex items-center gap-4">


            {{-- Language Dropdown --}}
            <x-dropdown align="right" width="40">

                <x-slot name="trigger">

                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900">

                        <span>
                            🌐 {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                        </span>


                        <div class="ml-2">

                            <svg
                                class="h-4 w-4 fill-current"
                                viewBox="0 0 20 20">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </div>

                    </button>

                </x-slot>


                <x-slot name="content">


                    <x-dropdown-link
                        :href="route('language.switch','en')">

                        English

                    </x-dropdown-link>


                    <x-dropdown-link
                        :href="route('language.switch','ar')">

                         العربية

                    </x-dropdown-link>


                </x-slot>

            </x-dropdown>



            {{-- User Dropdown --}}
            <x-dropdown align="right" width="48">

                <x-slot name="trigger">

                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900">

                        <div>
                            {{ Auth::user()->name }}
                        </div>


                        <div class="ml-2">

                            <svg
                                class="h-4 w-4 fill-current"
                                viewBox="0 0 20 20">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </div>

                    </button>

                </x-slot>


                <x-slot name="content">


                    <x-dropdown-link :href="route('profile.edit')">

                        {{ __('messages.profile') }}

                    </x-dropdown-link>


                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">

                            {{ __('messages.logout') }}

                        </x-dropdown-link>

                    </form>


                </x-slot>

            </x-dropdown>


        </div>


    </div>

</nav>

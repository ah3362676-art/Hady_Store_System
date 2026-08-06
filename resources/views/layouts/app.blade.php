<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        {{ config('app.name', __('messages.app_name')) }}
    </title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet" />


    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


</head>


<body class="font-sans antialiased">


    <div
        x-data="{ open: true }"
        class="flex h-screen bg-gray-100">


        {{-- Sidebar --}}
        @include('layouts.sidebar')



        {{-- Page Content --}}
        <div class="flex flex-1 flex-col overflow-hidden">


            {{-- Top Navigation --}}
            @include('layouts.navigation')



            {{-- Optional Header --}}
            @isset($header)

                <header class="bg-white shadow">

                    <div class="px-6 py-5">

                        {{ $header }}

                    </div>

                </header>

            @endisset




            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto p-6">


                {{ $slot }}


            </main>


        </div>


    </div>



    {{-- Extra Scripts --}}
    @stack('scripts')


</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hady Store</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-hidden bg-slate-50 font-sans text-gray-800">

    <!-- Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">

        <div
            class="absolute -top-40 -left-40 h-[450px] w-[450px] rounded-full bg-blue-300/30 blur-3xl">
        </div>

        <div
            class="absolute top-1/3 -right-32 h-[420px] w-[420px] rounded-full bg-indigo-300/20 blur-3xl">
        </div>

        <div
            class="absolute bottom-0 left-1/3 h-[320px] w-[320px] rounded-full bg-cyan-200/30 blur-3xl">
        </div>

    </div>

    <div class="relative flex min-h-screen items-center justify-center px-6 py-10">

        <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-14 items-center">

            <!-- Left Side -->
            <div class="hidden lg:block">

                <div class="flex items-center gap-5">

                    <img src="{{ asset('images/hady.png') }}"
                        class="h-24 w-24 object-contain mix-blend-multiply">

                    <div>

                        <h1
                            class="text-5xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Hady Store
                        </h1>

                        <p class="mt-3 text-lg text-gray-600">
                            Professional Cleaning Store Management
                        </p>

                    </div>

                </div>

                <h2 class="mt-10 text-5xl font-black leading-tight text-gray-900">
                    Welcome  👋
                </h2>

                <p class="mt-6 text-xl leading-9 text-gray-600">
                    Sign in to continue managing products, suppliers, inventory,
                    customers and sales with a modern dashboard.
                </p>

                <div class="mt-12 grid grid-cols-2 gap-5">

                    <div
                        class="rounded-3xl border border-white/50 bg-white/70 backdrop-blur-xl p-6 shadow-xl">
                        <div class="text-5xl">📦</div>
                        <h3 class="mt-4 font-bold text-xl">Products</h3>
                        <p class="mt-2 text-gray-500 text-sm">
                            Manage your inventory easily.
                        </p>
                    </div>

                    <div
                        class="rounded-3xl border border-white/50 bg-white/70 backdrop-blur-xl p-6 shadow-xl">
                        <div class="text-5xl">🛒</div>
                        <h3 class="mt-4 font-bold text-xl">Sales</h3>
                        <p class="mt-2 text-gray-500 text-sm">
                            Create invoices professionally.
                        </p>
                    </div>

                </div>

            </div>

            <!-- Login Card -->
            <div
                class="rounded-[32px] border border-white/50 bg-white/80 backdrop-blur-2xl shadow-2xl p-8 md:p-10">

                <div class="flex justify-center lg:hidden mb-8">

                    <img src="{{ asset('images/logo.png') }}"
                        class="h-20 w-20 object-contain mix-blend-multiply">

                </div>

                {{ $slot }}

            </div>

        </div>

    </div>

</body>

</html>

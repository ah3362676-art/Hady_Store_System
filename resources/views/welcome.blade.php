<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hady Store</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-x-hidden bg-slate-50 text-gray-800">

    <!-- Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">

        <div
            class="absolute -top-40 -left-40 h-[450px] w-[450px] rounded-full bg-blue-300/30 blur-3xl">
        </div>

        <div
            class="absolute top-1/3 -right-32 h-[420px] w-[420px] rounded-full bg-indigo-300/20 blur-3xl">
        </div>

        <div
            class="absolute bottom-0 left-1/3 h-[300px] w-[300px] rounded-full bg-cyan-200/30 blur-3xl">
        </div>

    </div>

<div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-white/30 bg-white/70 backdrop-blur-xl shadow-lg">

        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-5 group">

                <img
                    src="{{ asset('images/hady.png') }}"
                    alt="Hady Store"
                    class="h-16 w-16 object-contain mix-blend-multiply transition-all duration-500 group-hover:rotate-6 group-hover:scale-110"
                >

                <div>

                    <h1 class="text-3xl font-black tracking-wide bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Hady Store
                    </h1>

                    <p class="text-sm text-gray-500 tracking-wide">
                        Cleaning Store Management
                    </p>

                </div>

            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center gap-4">

                <a href="{{ route('login') }}"
                   class="rounded-xl border border-blue-600 px-6 py-2.5 font-semibold text-blue-600 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-600 hover:text-white hover:shadow-lg">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-2.5 font-semibold text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-blue-300">
                    Register
                </a>

            </nav>

        </div>

    </header>

    <!-- Hero -->
    <section class="flex-1">

        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid lg:grid-cols-2 gap-20 items-center">

                <!-- Image -->
                <div class="flex justify-center">

                    <div class="relative">

                        <div class="absolute inset-0 rounded-full bg-blue-400/20 blur-3xl scale-110"></div>

                        <img
                            src="{{ asset('images/hady.png') }}"
                            alt="Hady Store"
                            class="relative w-full max-w-md object-contain mix-blend-multiply drop-shadow-[0_35px_60px_rgba(37,99,235,.25)] transition-all duration-700 hover:scale-105 لال"
                        >

                    </div>

                </div>

                <!-- Content -->
                <div>

                    <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-lg">
                        ✨ Professional Store Management
                    </span>

                    <h2 class="mt-7 text-6xl font-black leading-tight text-gray-900">

                        Manage Your

                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Cleaning Store
                        </span>

                        Easily

                    </h2>

                    <p class="mt-8 text-xl leading-9 text-gray-600">

                        Hady Store helps you manage products, suppliers,
                        customers, sales, inventory and reports through a
                        beautiful dashboard with a modern experience,
                        powerful performance and an easy workflow.

                    </p>

                    <!-- Cards -->
                    <div class="mt-14 grid grid-cols-2 lg:grid-cols-3 gap-6">
                                                <!-- Products -->
                        <a href="{{ route('products.index') }}"
                           class="group relative overflow-hidden rounded-3xl border border-white/60 bg-white/90 p-7 shadow-xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-blue-200">

                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-white opacity-0 transition duration-500 group-hover:opacity-100"></div>

                            <div class="relative text-6xl transition duration-500 group-hover:scale-110">
                                📦
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Products
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-gray-500">
                                Manage all products, prices and inventory with ease.
                            </p>

                        </a>

                        <!-- Categories -->
                        <a href="{{ route('categories.index') }}"
                           class="group relative overflow-hidden rounded-3xl border border-white/60 bg-white/90 p-7 shadow-xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-blue-200">

                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-white opacity-0 transition duration-500 group-hover:opacity-100"></div>

                            <div class="relative text-6xl transition duration-500 group-hover:scale-110">
                                🗂️
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Categories
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-gray-500">
                                Organize products into categories for easier management.
                            </p>

                        </a>

                        <!-- Suppliers -->
                        <a href="{{ route('suppliers.index') }}"
                           class="group relative overflow-hidden rounded-3xl border border-white/60 bg-white/90 p-7 shadow-xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-blue-200">

                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-white opacity-0 transition duration-500 group-hover:opacity-100"></div>

                            <div class="relative text-6xl transition duration-500 group-hover:scale-110">
                                🚚
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Suppliers
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-gray-500">
                                Keep supplier information and purchases organized.
                            </p>

                        </a>

                        <!-- Customers -->
                        <a href="{{ route('customers.index') }}"
                           class="group relative overflow-hidden rounded-3xl border border-white/60 bg-white/90 p-7 shadow-xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-blue-200">

                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-white opacity-0 transition duration-500 group-hover:opacity-100"></div>

                            <div class="relative text-6xl transition duration-500 group-hover:scale-110">
                                👥
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Customers
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-gray-500">
                                Manage customer information and purchase history.
                            </p>

                        </a>

                        <!-- Sales -->
                        <a href="{{ route('sales.index') }}"
                           class="group relative overflow-hidden rounded-3xl border border-white/60 bg-white/90 p-7 shadow-xl backdrop-blur-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-blue-200">

                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-white opacity-0 transition duration-500 group-hover:opacity-100"></div>

                            <div class="relative text-6xl transition duration-500 group-hover:scale-110">
                                🛒
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Sales
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-gray-500">
                                Create invoices and manage sales professionally.
                            </p>

                        </a>

                        <!-- Hady Store -->
                        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 p-7 text-white shadow-2xl">

                            <div class="absolute -right-10 -top-10 h-36 w-36 rounded-full bg-white/10"></div>
                            <div class="absolute -left-10 -bottom-10 h-28 w-28 rounded-full bg-white/10"></div>

                            <div class="relative text-6xl">
                                🧹
                            </div>

                            <h3 class="relative mt-5 text-2xl font-bold">
                                Hady Store
                            </h3>

                            <p class="relative mt-3 text-sm leading-6 text-blue-100">
                                Fast, secure and professional management system designed for cleaning stores.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
        <!-- Footer -->
    <footer class="relative mt-20 overflow-hidden bg-gradient-to-r from-slate-900 via-gray-900 to-slate-800 text-gray-300">

        <!-- Background Effects -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 left-10 h-72 w-72 rounded-full bg-blue-500 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-indigo-500 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-12">

            <div class="flex flex-col md:flex-row items-center justify-between gap-8">

                <!-- Left -->
                <div class="flex items-center gap-4">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Hady Store"
                        class="h-14 w-14 object-contain mix-blend-multiply rounded-xl bg-white p-2 shadow-lg"
                    >

                    <div>

                        <h3 class="text-2xl font-bold text-white">
                            Hady Store
                        </h3>

                        <p class="text-sm text-gray-400">
                            Professional Cleaning Store Management System
                        </p>

                    </div>

                </div>

                <!-- Right -->
                <div class="flex items-center gap-4">

                    {{-- <a href="{{ route('login') }}"
                       class="rounded-xl border border-white/20 px-5 py-2 transition duration-300 hover:border-blue-400 hover:bg-blue-600 hover:text-white">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2 text-white shadow-lg transition duration-300 hover:scale-105">
                        Register
                    </a> --}}

                </div>

            </div>

            <div class="my-8 h-px bg-gradient-to-r from-transparent via-gray-700 to-transparent"></div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm">

                <p class="text-gray-400">
                    © {{ date('Y') }} Hady Store. All rights reserved.
                </p>


            </div>

        </div>

    </footer>

</div>

</body>
</html>

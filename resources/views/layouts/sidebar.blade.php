<aside
    :class="open ? 'w-64' : 'w-20'"
    class="bg-gray-900 text-white h-screen transition-all duration-300 overflow-visible flex flex-col"
>

    <!-- Logo -->
    <div class="flex items-center justify-center h-20 px-4 border-b border-gray-800">

        <!-- Open Sidebar Logo -->
        <div
            x-show="open"
            x-transition
            class="flex flex-col items-center"
        >

            <h1 class="text-2xl font-black tracking-[0.25em] text-white">
                HADY
            </h1>

            <div class="flex items-center gap-2 my-1.5">
                <span class="w-7 h-px bg-blue-500"></span>

                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                <span class="w-7 h-px bg-blue-500"></span>
            </div>

            <span class="text-[10px] font-medium tracking-[0.55em] text-gray-400 ml-1">
                STORE
            </span>

        </div>


        <!-- Closed Sidebar Logo -->
        <div
            x-show="!open"
            x-transition
        >

            <div
                class="w-11 h-11 flex items-center justify-center rounded-xl
                       bg-gradient-to-br from-blue-500 to-indigo-600
                       shadow-lg shadow-blue-900/30"
            >

                <span class="text-lg font-black text-white">
                    H
                </span>

            </div>

        </div>

    </div>


    <!-- Menu -->
    <nav class="flex-1 mt-4">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">🏠</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.dashboard') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.dashboard') }}
            </span>

        </a>


        <!-- Categories -->
        <a href="{{ route('categories.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">🗂️</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.categories') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.categories') }}
            </span>

        </a>


        <!-- Brands -->
        <a href="{{ route('brands.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">🏷️</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.brands') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.brands') }}
            </span>

        </a>


        <!-- Units -->
        <a href="{{ route('units.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">📏</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.units') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.units') }}
            </span>

        </a>


        <!-- Products -->
        <a href="{{ route('products.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">📦</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.products') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.products') }}
            </span>

        </a>


        <!-- Suppliers -->
        <a href="{{ route('suppliers.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">🚚</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.suppliers') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.suppliers') }}
            </span>

        </a>


        <!-- Purchases -->
        <a href="{{ route('purchases.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">📥</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.purchases') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.purchases') }}
            </span>

        </a>


        <!-- Customers -->
        <a href="{{ route('customers.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">👥</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.customers') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.customers') }}
            </span>

        </a>


        <!-- Sales -->
        <a href="{{ route('sales.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">🛒</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.sales') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.sales') }}
            </span>

        </a>


        <!-- Customer Payments -->
        <a href="{{ route('customer-payments.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">💵</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.customer_payments') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.customer_payments') }}
            </span>

        </a>


        <!-- Supplier Payments -->
        <a href="{{ route('supplier-payments.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">💸</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.supplier_payments') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.supplier_payments') }}
            </span>

        </a>


        <!-- Reports -->
        <a href="{{ route('reports.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">📊</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.reports') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.reports') }}
            </span>

        </a>

              <!-- backups -->
        <a href="{{ route('backup.index') }}"
           class="group relative flex items-center px-4 py-3 hover:bg-gray-800 transition">

            <span class="text-xl">💾</span>

            <span x-show="open" class="ml-4 whitespace-nowrap">
                {{ __('messages.backups') }}
            </span>

            <span
                x-show="!open"
                class="hidden group-hover:block absolute left-16 bg-gray-800 px-3 py-1 rounded shadow-lg whitespace-nowrap z-50"
            >
                {{ __('messages.backups') }}
            </span>

        </a>

    </nav>

</aside>


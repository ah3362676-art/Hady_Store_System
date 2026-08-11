<x-guest-layout>

    <div class="mb-8 text-center">

        <h2 class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Create Account
        </h2>

        <p class="mt-3 text-gray-500">
            Join Hady Store and start managing your business professionally.
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">

        @csrf

        <!-- Name -->
        <div>

            <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
                Full Name
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Enter your full name"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('name')" class="mt-2"/>

        </div>

        <!-- Email -->
        <div>

            <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">
                Email Address
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="Enter your email"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>

        </div>

        <!-- Password -->
        <div>

            <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                Password
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Create a password"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>

        </div>

        <!-- Confirm Password -->
        <div>

            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-gray-700">
                Confirm Password
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm your password"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>

        </div>

        <!-- Register Button -->
        <button
            type="submit"
            class="w-full rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 py-3 text-lg font-bold text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-blue-300">

            Create Account

        </button>

        <!-- Login Link -->
        <div class="text-center text-sm text-gray-500">

            Already have an account?

            <a href="{{ route('login') }}"
                class="font-bold text-blue-600 hover:text-indigo-600 transition">
                Login
            </a>

        </div>

    </form>

</x-guest-layout>

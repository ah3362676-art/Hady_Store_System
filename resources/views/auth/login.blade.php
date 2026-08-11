<x-guest-layout>

    <div class="mb-8 text-center">
        <h2
            class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Welcome Back
        </h2>

        <p class="mt-3 text-gray-500">
            Sign in to your Hady Store account
        </p>
    </div>

    <x-auth-session-status class="mb-5 rounded-xl bg-green-100 p-3 text-green-700"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">

        @csrf

        <!-- Email -->
        <div>

            <label for="email"
                class="mb-2 block text-sm font-semibold text-gray-700">
                Email Address
            </label>

            <input id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- Password -->
        <div>

            <label for="password"
                class="mb-2 block text-sm font-semibold text-gray-700">
                Password
            </label>

            <input id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
                class="w-full rounded-2xl border border-gray-200 bg-white/80 px-5 py-3 shadow-sm outline-none transition duration-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">

            <label class="flex items-center gap-2">

                <input id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                <span class="text-sm text-gray-600">
                    Remember Me
                </span>

            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-blue-600 hover:text-indigo-600 transition">
                    Forgot Password?
                </a>
            @endif

        </div>

        <!-- Button -->
        <button
            type="submit"
            class="w-full rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 py-3 text-lg font-bold text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-blue-300">

            Login

        </button>

    </form>

    @if (Route::has('register'))
        <div class="mt-8 text-center text-sm text-gray-500">

            Don't have an account?

            <a href="{{ route('register') }}"
                class="font-bold text-blue-600 hover:text-indigo-600">
                Create Account
            </a>

        </div>
    @endif

</x-guest-layout>

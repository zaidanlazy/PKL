<x-guest-layout>
        <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden dark:bg-zinc-900">
            <!-- Back Button -->
            <div class="px-6 pt-4">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            
            <!-- Header  Logo -->
            <div class="p-8 text-center border-b border-gray-100 dark:border-zinc-800">
                <div class="flex justify-center mb-4">
                    <div class="bg-white p-3 rounded-full light:bg-white">
                       <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-14 w-14 object-contain" />
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">BADAK LNG </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">LOGIN</p>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-sm text-blue-600 dark:text-blue-400" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email  -->
                    <div>
                        <x-input-label for="email" :value="__('EMAIL')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                        <x-text-input 
                            id="email" 
                            class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" 
                            placeholder=""
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Password  -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <x-input-label for="password" :value="__('PASSWORD')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline dark:text-blue-400">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input 
                            id="password" 
                            class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            placeholder=""
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded dark:bg-zinc-800 dark:border-zinc-700" 
                            name="remember"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <!-- Sign In Button -->
                    <div>
                        <x-primary-button class="w-full flex justify-center py-2 px-4 rounded text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('SIGN IN') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Registration Link -->
                <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">{{ __('Sign up') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

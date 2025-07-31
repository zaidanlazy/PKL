<x-guest-layout>
        <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden dark:bg-zinc-900">
            <!-- Header Logo -->
            <div class="p-8 text-center border-b border-gray-100 dark:border-zinc-800">
                <div class="flex justify-center mb-4">
                    <div class="bg-white p-3 rounded-full light:bg-white">
                        <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-14 w-14 object-contain" />
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">BADAK LNG</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">REGISTER</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-8 space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('NAME')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="name" class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('EMAIL')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="email" class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('PASSWORD')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="password" class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('CONFIRM PASSWORD')" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600 dark:text-red-400" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-blue-600 hover:underline dark:text-blue-400 rounded-md focus:outline-none" href="{{ route('login') }}">
                        {{ __('SUDAH PUNYA AKUN ?') }}
                    </a>
                    <x-primary-button class="ms-4 w-32 flex justify-center py-2 px-4 rounded text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

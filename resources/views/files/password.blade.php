@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-100 px-4 py-12">
    <div class="max-w-md w-full bg-white p-10 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl">
        {{-- Logo Container with subtle animation --}}
        <div class="flex justify-center mb-8">
            <div class="bg-white p-4 rounded-full shadow-sm border border-gray-200 transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/badaklng.png') }}" alt="Logo Badak LNG" class="w-16 h-auto">
            </div>
        </div>

        {{-- Header Section --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">BADAK.LNG</h1>
            <p class="text-gray-600 text-sm">File dipassword</p>

            {{-- Error Message with improved styling --}}
            @if($errors->has('password_input'))
                <div class="mt-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first('password_input') }}</span>
                </div>
            @endif
        </div>

        {{-- Password Form --}}
        <form method="POST" action="{{ route('files.check-password', $file->id) }}" class="space-y-6">
            @csrf
            <input type="hidden" name="access_granted" value="1">

            {{-- Password Input Field --}}
            <div class="space-y-2">
                <label for="password_input" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password_input"
                        name="password_input"
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                        required
                        autofocus>
                    <button
                        type="button"
                        class="absolute right-3 top-3 text-gray-400 hover:text-blue-500 transition-colors duration-200 focus:outline-none"
                        onclick="togglePasswordVisibility()"
                        aria-label="Toggle password visibility">
                        <svg id="eye-icon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg id="eye-off-icon" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Pastikan memasukkan password dengan benar</p>
            </div>

            {{-- Submit Button --}}
            <div>
                <button
                    type="submit"
                    class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:scale-95">
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Akses File
                    </span>
                </button>
            </div>
        </form>

        {{-- Footer Note --}}
        <div class="mt-6 text-center text-xs text-gray-400">
            <p>Hubungi Pemilik File tersebut</p>
        </div>
    </div>
</div>


<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password_input');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }

        // Maintain focus after toggle
        passwordInput.focus();
    }

    // Focus the password input on page load
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password_input');
        passwordInput.focus();

        // Add animation class on load
        const formContainer = document.querySelector('div > div');
        formContainer.classList.add('animate-fade-in-up');
    });
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

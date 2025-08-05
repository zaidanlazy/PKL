@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg border border-gray-200">

        {{-- Logo Badak LNG --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/badaklng.png') }}" alt="Logo Badak LNG" class="w-28 h-auto">
        </div>

        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">File Dilindungi Password</h2>
            <p class="text-sm text-gray-600 mt-1">Masukkan password untuk membuka file ini.</p>
        </div>

        @if($errors->has('password_input'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                {{ $errors->first('password_input') }}
            </div>
        @endif

        <form method="GET" action="{{ url()->current() }}">
            <input type="hidden" name="access_granted" value="1">

           <div class="mb-6">
    <input type="password" name="password_input" placeholder="Masukkan password"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
</div>


            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Akses File</button>
        </form>
    </div>
</div>

<style>
    .otp-input::-webkit-inner-spin-button,
    .otp-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .otp-input {
        font-family: monospace;
    }
</style>

<script>
    const inputs = document.querySelectorAll('.otp-input');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
</script>
@endsection

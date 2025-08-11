{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 px-4 py-12">
    <div class="text-center max-w-md w-full bg-white p-10 rounded-xl shadow-lg border border-gray-100 overflow-hidden relative">
        {{-- Decorative elements --}}
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        
        {{-- Logo --}}
        <div class="mb-8 flex justify-center">
            <div class="p-4 bg-white rounded-xl shadow-sm border border-gray-100 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                <img src="{{ asset('images/badaklng.png') }}" alt="Logo Badak LNG" class="w-16 h-auto opacity-90 hover:opacity-100 transition-opacity">
            </div>
        </div>

        {{-- Error number --}}
        <div class="relative mb-8">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-blue-50 rounded-full blur opacity-75 animate-pulse"></div>
            <h1 class="relative text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">
                404
            </h1>
        </div>

        {{-- Message --}}
        <div class="space-y-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 text-[15px] leading-relaxed max-w-xs mx-auto">
                Maaf, konten yang Anda cari tidak dapat ditemukan. Mungkin telah dipindahkan atau tidak tersedia lagi.
            </p>
        </div>

        {{-- Contact (Atas) --}}
        <a href="tel:087334342723"
           class="text-xs text-gray-500 hover:text-blue-600 transition-colors duration-300 flex items-center justify-center gap-1.5 group mb-6">
            <span class="px-2 py-1 bg-gray-100 group-hover:bg-blue-50 rounded-full transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </span>
            Butuh bantuan teknis? Hubungi kami
        </a>

        {{-- Contact (Bawah) --}}
                    <div class="flex justify-center items-center mt-4 text-sm text-gray-600 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2a1 1 0 011 1v3a1 1 0 01-.293.707L6.414 9.414a16 16 0 007.172 7.172l1.707-1.707A1 1 0 0116 14h3a1 1 0 011 1v2a2 2 0 01-2 2h-.5C10.492 19 5 13.508 5 6.5V6a1 1 0 00-1-1H3a2 2 0 00-2 2v0z" />
                     </svg>
                    <a href="tel:087334342723" class="hover:text-blue-600 transition-colors duration-300">0873-3434-2723</a>
            </div>
        </div>
    </div>
@endsection

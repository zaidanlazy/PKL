{{-- resources/views/files/expired.blade.php --}}
@extends('layouts.app', ['hideBackButton' => true])

@section('content')
<div class="min-h-screen flex items-center justify-center bg-red-50 px-4 py-12">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg border border-red-200 text-center">
        <div class="mb-6">
            <svg class="w-16 h-16 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Link Sudah Expired</h2>
        <p class="text-gray-600">Maaf, file ini sudah tidak tersedia karena telah melewati tanggal kedaluwarsa.</p>
    </div>
</div>
@endsection

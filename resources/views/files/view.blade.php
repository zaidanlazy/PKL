@extends('layouts.app')

@section('content')
  {{-- Header Section --}}
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 px-4 py-12">
    <div class="max-w-2xl w-full bg-white p-10 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl">

      {{-- Logo Container with subtle animation --}}
        <div class="flex justify-center mb-8">
            <div class="bg-white p-4 rounded-full shadow-sm border border-gray-200 transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/badaklng.png') }}" alt="Logo Badak LNG" class="w-16 h-auto">
            </div>
        </div>
        {{-- Header with decorative elements --}}
        <div class="text-center mb-8 relative">
            <div class="absolute -top-3 -left-3 w-12 h-12 bg-blue-100 rounded-full mix-blend-multiply filter blur-lg opacity-60"></div>
            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-blue-200 rounded-full mix-blend-multiply filter blur-lg opacity-60"></div>
            
            <h2 class="text-3xl font-bold text-gray-800 relative z-10">BADAK.LNG</h2>
            <p class="text-gray-600 mt-2">Informasi lengkap tentang file yang dibagikan</p>
        </div>

        {{-- File Information Card --}}
        <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Nama File:</span>
                        <span class="font-semibold text-gray-800">{{ $file->filename }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Nama Asli:</span>
                        <span class="font-semibold text-gray-800">{{ $file->original_name }}</span>
                    </div>
                    @if($file->category)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Kategori:</span>
                        <span class="font-semibold text-gray-800">{{ $file->category }}</span>
                    </div>
                    @endif
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Ukuran:</span>
                        <span class="font-semibold text-gray-800">{{ number_format(Storage::size('public/' . $file->path) / 1024, 2) }} KB</span>
                    </div>
                    @if($file->expired_at)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Kadaluarsa:</span>
                        <span class="font-semibold text-gray-800">{{ $file->expired_at->format('d M Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            @if($file->description)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <span class="font-medium text-gray-600">Deskripsi:</span>
                <p class="mt-1 text-gray-700">{{ $file->description }}</p>
            </div>
            @endif
        </div>

        {{-- File Preview Section --}}
        <div class="mb-8">
            <h3 class="text-center text-lg font-semibold text-gray-700 mb-4">Pratinjau File</h3>
            
            @php
                $ext = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));
            @endphp

            <div class="flex justify-center">
                @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg']))
                    <div class="relative group">
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="block">
                            <img src="{{ asset('storage/' . $file->path) }}" 
                                 alt="Preview File" 
                                 class="max-h-96 rounded-lg shadow-md border border-gray-200 transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 rounded-lg"></div>
                        </a>
                    </div>
                @elseif($ext === 'pdf')
                    <div class="relative group w-full">
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="block">
                            <div class="h-96 w-full bg-gray-100 rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                <iframe src="{{ asset('storage/' . $file->path) }}" 
                                        class="w-full h-full pointer-events-none"></iframe>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="text-center p-8 bg-gray-50 rounded-lg border border-gray-200 w-full">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-200 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500">Pratinjau tidak tersedia untuk file jenis ini</p>
                        <p class="text-xs text-gray-400 mt-1">Ekstensi file: .{{ $ext }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Download Button --}}
        <div class="flex justify-center">
            <a href="{{ route('files.download', $file->custom_link ?? $file->id) }}"
               class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Download File
            </a>
        </div>

        {{-- Footer Note --}}
        @if($file->expired_at && now()->lt($file->expired_at))
        <div class="mt-6 text-center text-xs text-gray-400">
            <p>File ini akan kadaluarsa pada {{ $file->expired_at->format('d M Y H:i') }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
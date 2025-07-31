@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Upload Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">Upload File</h1>
                <p class="text-blue-100 mt-1">Upload and manage your files</p>
            </div>
        </div>

        <!-- Upload Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- File Upload Section -->
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Choose File
                            </label>
                            <input type="file" id="file" name="file" 
                                   class="block w-full text-sm text-gray-500 dark:text-gray-400
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                          dark:file:bg-blue-900/30 dark:file:text-blue-400
                                          dark:hover:file:bg-blue-900/50"
                                   accept="*/*" required>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                File dapat diakses di file explorer. Maksimal 25MB per file.
                            </p>
                        </div>
                    </div>

                    <!-- File Name Section -->
                    <div>
                        <label for="filename" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama File
                        </label>
                        <input type="text" id="filename" name="filename" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Masukkan nama file (opsional, akan menggunakan nama asli jika kosong)"
                               value="{{ old('filename') }}">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Jika kosong, akan menggunakan nama file asli
                        </p>
                    </div>

                    <!-- Share Link Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Share Link
                        </label>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="radio" id="share_public" name="share_link" value="public" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                       {{ old('share_link') == 'public' ? 'checked' : '' }}>
                                <label for="share_public" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Public</span> - Link dapat diakses kapan saja
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="share_private" name="share_link" value="private" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                       {{ old('share_link') == 'private' ? 'checked' : 'checked' }}>
                                <label for="share_private" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Private</span> - Link hanya dapat diakses oleh pemilik
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="share_password" name="share_link" value="password" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                       {{ old('share_link') == 'password' ? 'checked' : '' }}>
                                <label for="share_password" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Password Protected</span> - Link dengan password
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="share_request" name="share_link" value="request" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                       {{ old('share_link') == 'request' ? 'checked' : '' }}>
                                <label for="share_request" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Request Access</span> - Link dimintai persetujuan izin ke pemilik
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ url('/') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Uploaded Files Preview -->
        @if(session('success'))
            <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                
                @if(session('uploaded_file_link'))
                    <div class="mt-4 p-4 bg-white rounded-lg border border-green-200">
                        <h3 class="font-semibold text-gray-800 mb-2">Share Link untuk: {{ session('uploaded_file_name') }}</h3>
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="text-sm text-gray-600">Privacy:</span>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if(session('uploaded_file_privacy') == 'public') bg-blue-100 text-blue-800
                                @elseif(session('uploaded_file_privacy') == 'private') bg-gray-100 text-gray-800
                                @elseif(session('uploaded_file_privacy') == 'password') bg-yellow-100 text-yellow-800
                                @else bg-purple-100 text-purple-800
                                @endif">
                                {{ ucfirst(session('uploaded_file_privacy')) }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="text" value="{{ session('uploaded_file_link') }}" readonly 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-sm font-mono">
                            <button onclick="copyToClipboard('{{ session('uploaded_file_link') }}')" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                Copy Link
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Link ini dapat dibagikan kepada orang lain untuk mengakses file Anda.
                        </p>
                    </div>
                @endif
            </div>
        @endif

        @if($errors->any())
            <div class="mt-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-fill filename when file is selected
    document.getElementById('file').addEventListener('change', function() {
        const file = this.files[0];
        const filenameInput = document.getElementById('filename');
        
        if (file && !filenameInput.value) {
            // Remove file extension for display
            const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
            filenameInput.value = nameWithoutExt;
        }
    });

    // Copy link to clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.add('bg-green-600');
            button.classList.remove('bg-blue-600');
            
            setTimeout(function() {
                button.textContent = originalText;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-blue-600');
            }, 2000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
            alert('Failed to copy link. Please copy manually.');
        });
    }
</script>
@endsection 
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Save File Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-green-600 to-green-500 p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">Save File</h1>
                <p class="text-green-100 mt-1">Save files to your personal storage</p>
            </div>
        </div>

        <!-- Save File Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('files.save') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- File Upload Section -->
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-green-400 transition-colors">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
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
                                          file:bg-green-50 file:text-green-700
                                          hover:file:bg-green-100
                                          dark:file:bg-green-900/30 dark:file:text-green-400
                                          dark:hover:file:bg-green-900/50"
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
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Masukkan nama file (opsional, akan menggunakan nama asli jika kosong)"
                               value="{{ old('filename') }}">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Jika kosong, akan menggunakan nama file asli
                        </p>
                    </div>

                    <!-- File Category Section -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Kategori File
                        </label>
                        <select id="category" name="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Pilih kategori (opsional)</option>
                            <option value="document" {{ old('category') == 'document' ? 'selected' : '' }}>Document</option>
                            <option value="image" {{ old('category') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="video" {{ old('category') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="audio" {{ old('category') == 'audio' ? 'selected' : '' }}>Audio</option>
                            <option value="archive" {{ old('category') == 'archive' ? 'selected' : '' }}>Archive</option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Kategori membantu mengorganisir file Anda
                        </p>
                    </div>

                    <!-- Description Section -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi (Opsional)
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                  placeholder="Tambahkan deskripsi singkat tentang file ini">{{ old('description') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ url('/') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Save File
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <p class="mt-2 text-sm">
                    File telah berhasil disimpan ke penyimpanan Anda. 
                    <a href="{{ url('/') }}" class="underline font-medium">Lihat file di halaman utama</a>
                </p>
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
</script>
@endsection 
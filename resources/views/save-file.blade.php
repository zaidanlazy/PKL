@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8 transition-all duration-300 hover:shadow-xl">
            <div class="relative bg-gradient-to-r from-green-600 to-green-500 p-8 text-center">
                <div class="absolute inset-0 bg-gradient-to-t from-green-700/10 to-transparent"></div>
                <div class="relative z-10">
                    <div class="flex justify-center mb-4">
                        <div class="bg-white p-3 rounded-full shadow-lg transform hover:scale-105 transition-transform">
                            <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Save File</h1>
                    <p class="text-green-100 font-medium">Store files in your personal secure storage</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="p-8">
                <form method="POST" action="{{ route('files.save') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- File Upload Section -->
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-green-400 transition-colors duration-300 bg-gray-50 dark:bg-gray-700/50">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <div class="mb-4">
                            <label for="file" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2 cursor-pointer">
                                <span class="text-green-600 dark:text-green-400">Click to select</span> or drag and drop
                            </label>
                            <input type="file" id="file" name="file" 
                                   class="hidden"
                                   accept="*/*" required>
                            <div id="file-info" class="hidden mt-2">
                                <p class="text-sm font-medium text-gray-900 dark:text-white" id="file-name-display"></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400" id="file-size-display"></p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                Maximum file size: 100MB. All file types accepted.
                            </p>
                        </div>
                    </div>

                    <!-- File Name Section -->
                    <div>
                        <label for="filename" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            File Name
                        </label>
                        <input type="text" id="filename" name="filename" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white transition-colors"
                               placeholder="Custom file name (optional)"
                               value="{{ old('filename') }}">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Leave blank to use original file name
                        </p>
                    </div>

                    <!-- File Category Section -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            File Category
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <div>
                                <input type="radio" id="category-document" name="category" value="document" class="hidden peer" {{ old('category') == 'document' ? 'checked' : '' }}>
                                <label for="category-document" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-blue-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-sm">Document</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="category-image" name="category" value="image" class="hidden peer" {{ old('category') == 'image' ? 'checked' : '' }}>
                                <label for="category-image" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-green-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Image</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="category-video" name="category" value="video" class="hidden peer" {{ old('category') == 'video' ? 'checked' : '' }}>
                                <label for="category-video" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-purple-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Video</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="category-audio" name="category" value="audio" class="hidden peer" {{ old('category') == 'audio' ? 'checked' : '' }}>
                                <label for="category-audio" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-yellow-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                    <span class="text-sm">Audio</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="category-archive" name="category" value="archive" class="hidden peer" {{ old('category') == 'archive' ? 'checked' : '' }}>
                                <label for="category-archive" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-orange-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                    <span class="text-sm">Archive</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="category-other" name="category" value="other" class="hidden peer" {{ old('category') == 'other' ? 'checked' : '' }}>
                                <label for="category-other" class="flex flex-col items-center justify-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-colors">
                                    <svg class="w-6 h-6 text-gray-500 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                    </svg>
                                    <span class="text-sm">Other</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description (Optional)
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white transition-colors"
                                  placeholder="Add a brief description about this file">{{ old('description') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ url('/') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                            Save File
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-8 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-6 rounded-xl shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800 dark:text-green-200">File Saved Successfully!</h3>
                        <div class="mt-2 text-green-700 dark:text-green-300">
                            <p>{{ session('success') }}</p>
                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    View My Files
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mt-8 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-6 rounded-xl shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-red-800 dark:text-red-200">There was an error</h3>
                        <div class="mt-2 text-red-700 dark:text-red-300">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // File input handling
    const fileInput = document.getElementById('file');
    const fileInfo = document.getElementById('file-info');
    const fileNameDisplay = document.getElementById('file-name-display');
    const fileSizeDisplay = document.getElementById('file-size-display');
    const filenameInput = document.getElementById('filename');

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const file = this.files[0];
            
            // Display file info
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = formatFileSize(file.size);
            fileInfo.classList.remove('hidden');
            
            // Auto-fill filename if empty
            if (!filenameInput.value) {
                filenameInput.value = file.name.replace(/\.[^/.]+$/, "");
            }
        }
    });

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // Drag and drop functionality
    const dropZone = document.querySelector('.border-dashed');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropZone.classList.add('border-green-400', 'bg-green-50', 'dark:bg-green-900/10');
    }

    function unhighlight() {
        dropZone.classList.remove('border-green-400', 'bg-green-50', 'dark:bg-green-900/10');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            
            const file = files[0];
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = formatFileSize(file.size);
            fileInfo.classList.remove('hidden');
            
            if (!filenameInput.value) {
                filenameInput.value = file.name.replace(/\.[^/.]+$/, "");
            }
        }
    }
</script>
@endsection
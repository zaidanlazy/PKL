@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">

        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 transition-all duration-300 hover:shadow-xl">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 text-center relative">
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <div class="absolute inset-0 bg-white"></div>
                </div>
                <div class="relative z-10">
                    <div class="flex justify-center mb-4">
                        <div class="bg-white p-3 rounded-full shadow-lg transform hover:scale-105 transition-transform">
                            <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Share File</h1>
                    <p class="text-blue-100 font-medium">Share file Anda dengan aman</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="p-8">
                <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- File Upload Dropzone -->
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors duration-300 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <label for="file" class="block mt-4 text-lg font-medium text-gray-700 cursor-pointer">
                            <span class="text-blue-600">Pilih file</span> atau drag & drop disini
                        </label>
                       <input type="file" id="file" name="file" class="hidden" required accept=".pdf,.doc,.docx">
                        <p class="mt-2 text-sm text-gray-500">Maksimal 100MB. Format file bebas.</p>
                        <p id="file-name" class="mt-2 text-sm font-medium text-gray-900 hidden"></p>
                    </div>

                    <!-- Advanced Options Accordion -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Opsi Lanjutan</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Password Protection -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="enable_password" name="enable_password" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" onclick="togglePasswordInput()">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="enable_password" class="font-medium text-gray-700">Password Protection</label>
                                    <p class="text-gray-500">File hanya bisa diakses dengan password</p>
                                    <div id="password_field" class="mt-3 hidden">
                                        <input type="password" id="password" name="password" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password">
                                    </div>
                                </div>
                            </div>

                            <!-- Expiration Date -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="enable_expired" name="enable_expired" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" onclick="toggleExpiredInput()">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="enable_expired" class="font-medium text-gray-700">Expiration Date</label>
                                    <p class="text-gray-500">File akan otomatis dihapus setelah tanggal tertentu</p>
                                    <div id="expired_field" class="mt-3 hidden">
                                        <input type="date" id="expired_date" name="expired_date" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <p class="mt-1 text-xs text-gray-500">Default: 1 tahun dari sekarang</p>
                                    </div>
                                </div>
                            </div>

                            <!-- One Time View -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="one_time" name="one_time" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="one_time" class="font-medium text-gray-700">One Time View</label>
                                    <p class="text-gray-500">File hanya bisa diakses sekali saja</p>
                                </div>
                            </div>

                            <!-- Custom Link -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="enable_custom_link" name="enable_custom_link" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" onclick="toggleCustomLinkInput()">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="enable_custom_link" class="font-medium text-gray-700">Custom Link</label>
                                    <p class="text-gray-500">Buat link yang mudah diingat</p>
                                    <div id="custom_link_field" class="mt-3 hidden">
                                        <div class="flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                {{ config('app.url') }}/
                                            </span>
                                            <input type="text" id="custom_link" name="custom_link" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="contoh: laporan-2025">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ url('/') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out transform hover:-translate-y-0.5">
                            Share
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notifications -->
        @if(session('success'))
            <div class="mt-8 bg-green-50 border-l-4 border-green-500 p-6 rounded-xl shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Upload Berhasil!</h3>
                        <div class="mt-2 text-green-700">
                            <p>{{ session('success') }}</p>
                            @if(session('uploaded_file_link'))
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-green-800">Link File Anda:</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" readonly value="{{ session('uploaded_file_link') }}" class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
                                        <button onclick="copyToClipboard('{{ session('uploaded_file_link') }}')" class="inline-flex items-center px-4 rounded-r-md border border-l-0 border-gray-300 bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-green-600">Tipe privasi: {{ session('uploaded_file_privacy') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mt-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-xl shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-red-800">Ada masalah dengan upload Anda</h3>
                        <div class="mt-2 text-red-700">
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
    // Toggle functions
    function togglePasswordInput() {
        document.getElementById('password_field').classList.toggle('hidden');
    }

    function toggleExpiredInput() {
        const field = document.getElementById('expired_field');
        field.classList.toggle('hidden');
        if (!field.classList.contains('hidden')) {
            const defaultDate = new Date();
            defaultDate.setFullYear(defaultDate.getFullYear() + 1);
            document.getElementById('expired_date').value = defaultDate.toISOString().split('T')[0];
        }
    }

    function toggleCustomLinkInput() {
        document.getElementById('custom_link_field').classList.toggle('hidden');
    }

    // File input handler
    document.getElementById('file').addEventListener('change', function(e) {
        const fileName = document.getElementById('file-name');
        if (this.files.length > 0) {
            fileName.textContent = this.files[0].name;
            fileName.classList.remove('hidden');
        } else {
            fileName.classList.add('hidden');
        }
    });

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
        dropZone.classList.add('border-blue-400', 'bg-blue-50');
    }

    function unhighlight() {
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('file').files = files;
        const fileName = document.getElementById('file-name');
        if (files.length > 0) {
            fileName.textContent = files[0].name;
            fileName.classList.remove('hidden');
        }
    }

    // Copy to clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Show copied notification
            const button = event.currentTarget;
            const originalHTML = button.innerHTML;
            button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
            button.classList.remove('bg-blue-600');
            button.classList.add('bg-green-600');
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-blue-600');
            }, 2000);
        });
    }
</script>
@endsection
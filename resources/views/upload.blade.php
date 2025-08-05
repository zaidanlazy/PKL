@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">Upload File</h1>
                <p class="text-blue-100 mt-1">Upload dan kelola file Anda</p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Pilih File -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                        <input type="file" id="file" name="file" class="block w-full text-sm" required>
                        <p class="text-xs text-gray-500 mt-2">Maksimal 25MB. Format bebas.</p>
                    </div>

                    <!-- Nama File -->
                    <div>
                        <label for="filename" class="block text-sm font-medium text-gray-700 mb-2">Nama File (opsional)</label>
                        <input type="text" id="filename" name="filename" class="w-full px-3 py-2 border rounded-lg" placeholder="Masukkan nama file (tanpa ekstensi)">
                    </div>

                    <!-- Password (opsional) -->
                    <div class="flex items-center mt-4">
                        <input type="checkbox" id="enable_password" onclick="togglePasswordInput()" class="mr-2">
                        <label for="enable_password" class="text-sm text-gray-700">Password Protected</label>
                    </div>
                    <div id="password_field" class="hidden mt-2">
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Masukkan password (opsional)">
                    </div>

                    <!-- Expired Date (opsional) -->
                    <div class="flex items-center mt-4">
                        <input type="checkbox" id="enable_expired" onclick="toggleExpiredInput()" class="mr-2">
                        <label for="enable_expired" class="text-sm text-gray-700">Set Expired Date</label>
                    </div>
                    <div id="expired_field" class="hidden mt-2">
                        <input type="date" id="expired_date" name="expired_date" class="w-full px-3 py-2 border rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">Jika tidak diisi, akan diset otomatis 1 tahun dari sekarang.</p>
                    </div>

                    <!-- One Time View -->
                    <div class="flex items-center mt-4">
                        <input type="checkbox" id="one_time" name="one_time" class="mr-2">
                        <label for="one_time" class="text-sm text-gray-700">One Time View</label>
                    </div>

                    <!-- Custom Link -->
                    <div class="flex items-center mt-4">
                        <input type="checkbox" id="enable_custom_link" onclick="toggleCustomLinkInput()" class="mr-2">
                        <label for="enable_custom_link" class="text-sm text-gray-700">Custom Link</label>
                    </div>
                    <div id="custom_link_field" class="hidden mt-2">
                        <input type="text" id="custom_link" name="custom_link" class="w-full px-3 py-2 border rounded-lg" placeholder="Contoh: laporan-kerja-2025">
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end mt-6">
                        <a href="{{ url('/') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="ml-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
                <strong>Sukses:</strong> {{ session('success') }}<br>
                @if(session('uploaded_file_link'))
                    <div class="mt-2">
                        <p><strong>Link File:</strong></p>
                        <div class="flex">
                            <input type="text" readonly value="{{ session('uploaded_file_link') }}" class="flex-1 px-2 py-1 border rounded-l">
                            <button onclick="navigator.clipboard.writeText('{{ session('uploaded_file_link') }}')" class="bg-blue-600 text-white px-4 rounded-r">Copy</button>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">Tipe privasi: {{ session('uploaded_file_privacy') }}</p>
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

    document.getElementById('file').addEventListener('change', function () {
        const file = this.files[0];
        const filenameInput = document.getElementById('filename');
        if (file && filenameInput && !filenameInput.value) {
            const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
            filenameInput.value = nameWithoutExt;
        }
    });
</script>
@endsection

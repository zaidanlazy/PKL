@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8 transition-all duration-300 hover:shadow-xl">
            <div class="relative bg-gradient-to-r from-red-600 to-red-500 p-8 text-center">
                <div class="absolute inset-0 bg-gradient-to-t from-red-700/10 to-transparent"></div>
                <div class="relative z-10">
                    <div class="flex justify-center mb-4">
                        <div class="bg-white p-3 rounded-full shadow-lg transform hover:scale-105 transition-transform">
                            <img src="{{ asset('images/badaklng.png') }}" alt="Badak LNG Logo" class="h-16 w-16 object-contain" />
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Trash</h1>
                    <p class="text-red-100 font-medium">Manage your deleted files</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="p-6">
                <!-- Header with Stats -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Deleted Files</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ $files->count() }} files ·
                            @php
                                $totalSize = 0;
                                foreach($files as $file) {
                                    if(file_exists(storage_path('app/public/' . $file->path))) {
                                        $totalSize += filesize(storage_path('app/public/' . $file->path));
                                    }
                                }
                                echo number_format($totalSize / (1024 * 1024), 2) . ' MB';
                            @endphp
                        </p>
                    </div>

                    <!-- Search and Actions -->
                    <div class="w-full sm:w-auto">
                        <form method="GET" action="{{ route('trash') }}" class="flex gap-2">
                            <div class="relative flex-1 min-w-[200px]">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       name="search"
                                       value="{{ $search }}"
                                       placeholder="Search files..."
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search
                            </button>
                            @if($search)
                                <a href="{{ route('trash') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                @if($files->count() > 0)
                    <!-- Search Results Indicator -->
                    @if($search)
                        <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="text-sm text-blue-700 dark:text-blue-300">
                                Found {{ $files->count() }} file(s) matching "<span class="font-medium">{{ $search }}</span>"
                            </span>
                        </div>
                    @endif

                    <!-- Files Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-10">
                                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-red-600 focus:ring-red-500 dark:bg-gray-800 dark:border-gray-600">
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">File</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deleted</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($files as $file)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" class="file-checkbox rounded border-gray-300 text-red-600 focus:ring-red-500 dark:bg-gray-800 dark:border-gray-600" value="{{ $file->id }}">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700">
                                                    @if($file->category == 'image')
                                                        <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    @elseif($file->category == 'video')
                                                        <svg class="h-6 w-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                    @elseif($file->category == 'audio')
                                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                        </svg>
                                                    @elseif($file->category == 'archive')
                                                        <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white truncate max-w-xs">{{ $file->filename }}</div>
                                                    @if($file->description)
                                                        <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $file->description }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($file->category == 'document') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                                                @elseif($file->category == 'image') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                                @elseif($file->category == 'video') bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300
                                                @elseif($file->category == 'audio') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                                @elseif($file->category == 'archive') bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                @endif">
                                                {{ ucfirst($file->category ?? 'Other') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @if(file_exists(storage_path('app/public/' . $file->path)))
                                                {{ number_format(filesize(storage_path('app/public/' . $file->path)) / 1024, 1) }} KB
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">Missing</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $file->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button onclick="deleteFile({{ $file->id }}, '{{ $file->filename }}')"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 flex items-center"
                                                        title="Delete Permanently">
                                                    <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions -->
                    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            <span id="selected-count">0</span> files selected
                        </div>
                            <button id="bulk-delete" onclick="bulkDelete()"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center"
                                    disabled>
                                <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete All
                            </button>
                        </div>
                    </div>


                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        @if($search)
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No files found</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                No files match your search for "<span class="font-medium">{{ $search }}</span>"
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('trash') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Clear Search
                                </a>
                            </div>
                        @else
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Trash is empty</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Deleted files will appear here</p>
                            <div class="mt-6">
                                <a href="{{ route('files.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Go to Files
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 rounded shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-300 p-4 rounded shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-xl rounded-xl bg-white dark:bg-gray-800 transition-all duration-300 transform">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-4">Delete File Permanently</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Are you sure you want to permanently delete "<span id="delete-filename" class="font-medium text-gray-900 dark:text-white"></span>"?
                </p>
                <p class="text-xs text-red-500 mt-2">This action cannot be undone and the file will be lost forever.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-lg w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    Delete Permanently
                </button>
                <button onclick="closeDeleteModal()" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 text-base font-medium rounded-lg w-full shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div id="restore-modal" class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-xl rounded-xl bg-white dark:bg-gray-800 transition-all duration-300 transform">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30">
                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-4">Restore File</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Are you sure you want to restore "<span id="restore-filename" class="font-medium text-gray-900 dark:text-white"></span>"?
                </p>
                <p class="text-xs text-blue-500 mt-2">The file will be moved back to your files.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirm-restore" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-lg w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Restore File
                </button>
                <button onclick="closeRestoreModal()" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 text-base font-medium rounded-lg w-full shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedFiles = [];
    let fileToDelete = null;
    let fileToRestore = null;

    // Initialize checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        // Select all functionality
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.file-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.file-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });

    function updateSelectedCount() {
        const checkboxes = document.querySelectorAll('.file-checkbox:checked');
        const count = checkboxes.length;
        document.getElementById('selected-count').textContent = count;

        // Enable/disable bulk action buttons
        document.getElementById('bulk-delete').disabled = count === 0;
        document.getElementById('bulk-restore').disabled = count === 0;

        selectedFiles = Array.from(checkboxes).map(cb => cb.value);
    }

    // File deletion
    function deleteFile(fileId, filename) {
        fileToDelete = fileId;
        document.getElementById('delete-filename').textContent = filename;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        fileToDelete = null;
    }

    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (fileToDelete) {
            submitForm(`/files/${fileToDelete}/delete`, 'DELETE');
        }
    });

    // File restoration
    function restoreFile(fileId, filename) {
        fileToRestore = fileId;
        document.getElementById('restore-filename').textContent = filename || 'this file';
        document.getElementById('restore-modal').classList.remove('hidden');
    }

    function closeRestoreModal() {
        document.getElementById('restore-modal').classList.add('hidden');
        fileToRestore = null;
    }

    document.getElementById('confirm-restore')?.addEventListener('click', function() {
        if (fileToRestore) {
            submitForm(`/files/${fileToRestore}/restore`, 'PATCH');
        }
    });

    // Bulk actions
    function bulkDelete() {
        if (selectedFiles.length > 0) {
            const message = selectedFiles.length === 1
                ? 'Are you sure you want to permanently delete this file?'
                : `Are you sure you want to permanently delete ${selectedFiles.length} files?`;

            if (confirm(message + '\n\nThis action cannot be undone.')) {
                selectedFiles.forEach(fileId => {
                    submitForm(`/files/${fileId}/delete`, 'DELETE');
                });
            }
        }
    }

    function bulkRestore() {
        if (selectedFiles.length > 0) {
            const message = selectedFiles.length === 1
                ? 'Are you sure you want to restore this file?'
                : `Are you sure you want to restore ${selectedFiles.length} files?`;

            if (confirm(message)) {
                selectedFiles.forEach(fileId => {
                    submitForm(`/files/${fileId}/restore`, 'PATCH');
                });
            }
        }
    }

    // Helper function to submit forms
    function submitForm(url, method) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = method;

        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection

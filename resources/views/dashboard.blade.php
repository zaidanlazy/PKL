@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Dashboard</h1>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Last updated: {{ now()->format('d M Y, H:i') }}
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- File Upload Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                        <svg class="w-5 h-5 inline mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Upload File
                    </h2>
                </div>
                @include('components.file-upload')
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                        <svg class="w-5 h-5 inline mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Notifications
                    </h2>
                    <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full dark:bg-gray-700 dark:text-gray-200">
                        {{ count($notifications) }} New
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($notifications as $notif)
                        <div class="p-4 border-l-4 border-blue-500 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm transition-all duration-150 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex justify-between items-start">
                                <p class="text-gray-700 dark:text-gray-300">{{ $notif->message }}</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    @if(isset($notif->created_at))
                                        {{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                            No notifications available
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Badak.LNG' }}</title>

    <!-- TailwindCSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
    <div>
                     @if (!in_array(Route::currentRouteName(), ['files.view', 'files.expired', 'errors.404']))
                 <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            @endif
        </div>
        <div>
            {{-- Bisa ditambahkan menu profil, setting, dll --}}
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="p-6">
        @yield('content')
    </main>

    <!-- Komponen Notifikasi -->
    @include('components.notification')

</body>
</html>

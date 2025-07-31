<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'File Manager' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow p-4 flex justify-between">
        <div class="font-bold text-xl">FileManager</div>
        <div>
            <a href="{{ route('dashboard') }}" class="px-3 py-1">Dashboard</a>
            <a href="{{ route('files.index') }}" class="px-3 py-1">Files</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1 bg-transparent hover:underline text-blue-600">Logout</button>
            </form>
        </div>
    </nav>
    <main class="p-6">
        @yield('content')
    </main>
    @include('components.notification')
</body>
</html>

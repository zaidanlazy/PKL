@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-4">File Saya</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($files as $file)
            <div>
                @include('components.file-card', ['file' => $file])

                @if(session('share_link_' . $file->id))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow mt-2">
                        Link berhasil dibuat:
                        <input type="text" value="{{ session('share_link_' . $file->id) }}" readonly class="border rounded px-2 py-1 w-2/3">
                        <button onclick="navigator.clipboard.writeText('{{ session('share_link_' . $file->id) }}')" class="ml-2 px-2 py-1 bg-blue-500 text-white rounded">Copy</button>
                    </div>
                @else
                    <form method="POST" action="{{ route('files.share', $file->id) }}" class="mt-2 flex items-center gap-2">
                        @csrf
                        <label for="privacy-{{ $file->id }}" class="mr-2 font-medium">Akses Link:</label>
                        <select name="privacy" id="privacy-{{ $file->id }}" class="border rounded px-2 py-1">
                            <option value="public">Link dapat diakses kapan saja</option>
                            <option value="private">Link hanya dapat diakses oleh pemilik</option>
                            <option value="password">Link dengan password</option>
                            <option value="private">link dimintai persetujuan izin ke pemilik</option>
                        </select>
                        <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded"> Share Link</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection
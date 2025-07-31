@extends('layouts.app')
@section('content')
    @if($expired)
        @include('components.request-access-modal', ['file' => $file])
    @else
        <div class="bg-white p-6 rounded shadow text-center">
            <h1 class="text-xl font-bold mb-2">{{ $file->name }}</h1>
            <p class="mb-4">{{ $file->description }}</p>
            <a href="{{ route('files.download', $file->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">Download File</a>
        </div>
    @endif
@endsection
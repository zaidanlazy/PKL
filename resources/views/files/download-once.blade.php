@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>File Siap Diunduh</h2>
    <p>File ini hanya dapat diunduh sekali. Klik tombol di bawah untuk melanjutkan.</p>

    <form method="POST" action="{{ route('file.downloadOnce', $file->custom_link) }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Download Sekali Saja</button>
    </form>
</div>
@endsection

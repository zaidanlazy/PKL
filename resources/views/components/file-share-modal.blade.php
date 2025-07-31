@if(isset($show) && $show)
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="font-bold text-lg mb-2">Bagikan File</h2>
        <form action="{{ route('files.share', $file->id) }}" method="POST" class="flex flex-col gap-2">
            @csrf
            <label>
                <input type="radio" name="access_type" value="one_time" checked> Sekali lihat
            </label>
            <label>
                <input type="radio" name="access_type" value="expire"> Expired after
                <input type="number" name="expire_days" min="1" max="30" class="w-16 border rounded px-1 py-0.5 ml-2" placeholder="Hari">
            </label>
            <label>
                <input type="checkbox" name="require_login"> Harus login untuk akses
            </label>
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Generate Link</button>
        </form>
        @if(session('share_link'))
            <div class="mt-4">
                <input type="text" value="{{ session('share_link') }}" readonly class="w-full border rounded px-2 py-1">
                <small class="text-green-600">Link berhasil dibuat!</small>
            </div>
        @endif
        <button onclick="window.location='{{ url()->previous() }}'" class="mt-4 text-gray-500 hover:text-gray-700">Tutup</button>
    </div>
</div>
@endif
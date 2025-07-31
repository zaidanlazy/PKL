<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-96 text-center">
        <h2 class="font-bold text-lg mb-2">Link ini sudah tidak aktif</h2>
        <form action="{{ route('files.request-access', $file->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Minta akses ulang</button>
        </form>
    </div>
</div>
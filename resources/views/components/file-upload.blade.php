<form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 bg-white p-4 rounded shadow">
    @csrf
    <input type="file" name="file" required>
    <input type="text" name="name" placeholder="Nama file" class="border rounded px-2 py-1" required>
    <textarea name="description" placeholder="Deskripsi" class="border rounded px-2 py-1"></textarea>
    <input type="text" name="tags" placeholder="Tag (pisahkan dengan koma)" class="border rounded px-2 py-1">
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Upload</button>
</form>
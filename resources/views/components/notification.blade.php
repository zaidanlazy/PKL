@if(session('notification'))
    <div class="fixed top-4 right-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow">
        {{ session('notification') }}
    </div>
@endif
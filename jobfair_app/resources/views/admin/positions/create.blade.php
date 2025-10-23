<!DOCTYPE html>
<html lang="id"><head><title>Tambah Posisi</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-900 text-white">
    <div class="flex-1 p-8">
        <h2 class="text-3xl font-bold mb-8">Tambah Posisi Baru untuk {{ $company->name }}</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('admin.companies.positions.store', $company) }}" method="POST">
                @include('admin.positions._form', ['submitText' => 'Simpan'])
            </form>
        </div>
    </div>
</body>
</html>
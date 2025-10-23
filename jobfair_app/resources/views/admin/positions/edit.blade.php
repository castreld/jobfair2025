<!DOCTYPE html>
<html lang="id"><head><title>Ubah Posisi</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-900 text-white">
    <div class="flex-1 p-8">
        <h2 class="text-3xl font-bold mb-8">Ubah Posisi untuk {{ $company->name }}</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('admin.companies.positions.update', [$company, $position]) }}" method="POST">
                @method('PUT')
                @include('admin.positions._form', ['submitText' => 'Perbarui'])
            </form>
        </div>
    </div>
</body>
</html>
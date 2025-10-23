<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Perusahaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex">
        <div class="w-64 min-h-screen bg-gray-800 p-4">
            <h1 class="text-2xl font-bold mb-8">Admin Jobfair</h1>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.companies.index') }}" class="px-4 py-2 rounded bg-gray-700">Kelola Perusahaan</a>
                <a href="{{ route('admin.applicants.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Lihat Pelamar</a>
            </nav>
        </div>

        <div class="flex-1 p-8">
            <h2 class="text-3xl font-bold mb-8">Tambah Perusahaan Baru</h2>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <form action="{{ route('admin.companies.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block mb-2">Nama Perusahaan</label>
                        <input type="text" name="name" id="name" class="w-full px-3 py-2 bg-gray-700 rounded @error('name') border border-red-500 @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('admin.companies.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
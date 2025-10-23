<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Perusahaan</title>
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
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Kelola Perusahaan</h2>
                <a href="{{ route('admin.companies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Perusahaan
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-2">Nama Perusahaan</th>
                            <th class="py-2">Jumlah Posisi</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                        <tr class="border-b border-gray-700">
                            <td class="py-4">{{ $company->name }}</td>
                            <td class="py-4">{{ $company->positions->count() }}</td>
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.companies.positions.index', $company) }}" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded text-sm">
                                    Kelola Posisi
                                </a>
                                <a href="{{ route('admin.companies.edit', $company) }}" class="text-yellow-400 hover:text-yellow-300 ml-4">Ubah</a>
                                <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus perusahaan ini dan semua posisinya?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 ml-4">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center">Belum ada data perusahaan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
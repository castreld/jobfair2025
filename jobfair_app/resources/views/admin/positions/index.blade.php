<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Posisi</title>
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
            <div class="flex justify-between items-center mb-4">
                <div>
                    <a href="{{ route('admin.companies.index') }}" class="text-sky-400 hover:text-sky-300">&larr; Kembali ke Daftar Perusahaan</a>
                    <h2 class="text-3xl font-bold mt-2">Kelola Posisi untuk: {{ $company->name }}</h2>
                </div>
                <a href="{{ route('admin.companies.positions.create', $company) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Posisi
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-2">Nama Posisi</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($positions as $position)
                        <tr class="border-b border-gray-700">
                            <td class="py-4">{{ $position->name }}</td>
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.companies.positions.edit', [$company, $position]) }}" class="text-yellow-400 hover:text-yellow-300 mr-4">Ubah</a>
                                <form action="{{ route('admin.companies.positions.destroy', [$company, $position]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="py-4 text-center">Belum ada data posisi untuk perusahaan ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelamar di Sampah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex">
        <div class="w-64 min-h-screen bg-gray-800 p-4">
            <h1 class="text-2xl font-bold mb-8">Admin Jobfair</h1>
             <nav class="flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.companies.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Kelola Perusahaan</a>
                <a href="{{ route('admin.applicants.index') }}" class="px-4 py-2 rounded bg-gray-700">Lihat Pelamar</a>
            </nav>
        </div>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Pelamar di Sampah</h2>
                <a href="{{ route('admin.applicants.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali ke Daftar Pelamar
                </a>
            </div>

             @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="p-3">Nama Lengkap</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Tgl. Dihapus</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $applicant)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="p-3">{{ $applicant->full_name }}</td>
                            <td class="p-3">{{ $applicant->email }}</td>
                            <td class="p-3">{{ $applicant->deleted_at->format('d M Y, H:i') }}</td>
                            <td class="p-3 flex space-x-4">
                                <form action="{{ route('admin.applicants.restore', $applicant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:text-green-400">Pulihkan</button>
                                </form>
                                <form action="{{ route('admin.applicants.forceDelete', $applicant->id) }}" method="POST" onsubmit="return confirm('ANDA YAKIN? Tindakan ini akan menghapus data secara permanen dan tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-4 text-center">Tidak ada data di sampah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $applicants->links() }}
            </div>
        </div>
    </div>
</body>
</html>
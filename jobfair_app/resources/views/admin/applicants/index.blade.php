<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelamar</title>
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
                <h2 class="text-3xl font-bold">Daftar Pelamar</h2>
                <a href="{{ route('admin.applicants.trashed') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Lihat Sampah
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
                            <th class="p-3">Perusahaan Dilamar</th>
                            <th class="p-3">Posisi Dilamar</th>
                            <th class="p-3">Tgl. Daftar</th>
                            <th class="p-3">Berkas (.zip)</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $applicant)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="p-3">{{ $applicant->full_name }}</td>
                            <td class="p-3">{{ $applicant->email }}</td>
                            <td class="p-3">{{ $applicant->company->name ?? 'N/A' }}</td>
                            <td class="p-3">{{ $applicant->position->name ?? 'N/A' }}</td>
                            <td class="p-3">{{ $applicant->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-3">
                                <a href="{{ Storage::url($applicant->zip_path) }}" class="text-sky-400 hover:text-sky-300" download>
                                    Unduh
                                </a>
                            </td>
                            <td class="p-3 flex items-center space-x-4">
                                <a href="{{ route('admin.applicants.show', $applicant->id) }}" class="text-green-400 hover:text-green-300">Detail</a>
                                <form action="{{ route('admin.applicants.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('Pindahkan pelamar ini ke sampah?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400">Sampah</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="p-4 text-center">Belum ada data pelamar.</td></tr>
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
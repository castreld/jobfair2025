<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex">
        <div class="w-64 min-h-screen bg-gray-800 p-4">
            <h1 class="text-2xl font-bold mb-8">Admin Jobfair</h1>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.companies.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Kelola Perusahaan</a>
                <a href="{{ route('admin.applicants.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Lihat Pelamar</a>
            </nav>
        </div>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Selamat Datang, {{ auth('admin')->user()->name }}!</h2>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Keluar
                    </button>
                </form>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <p>Ini adalah dashboard admin Anda. Anda dapat mengelola perusahaan, posisi pekerjaan, dan melihat data pelamar dari sini.</p>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pelamar: {{ $applicant->full_name }}</title>
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
                <h2 class="text-3xl font-bold">Detail Pelamar</h2>
                <a href="{{ route('admin.applicants.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    &larr; Kembali ke Daftar
                </a>
            </div>

            <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1 text-center">
                        <img src="{{ Storage::url($applicant->photo_path) }}" alt="Foto Pelamar" class="w-40 h-40 rounded-full mx-auto object-cover mb-4 border-4 border-gray-700">
                        <h3 class="text-2xl font-bold">{{ $applicant->full_name }}</h3>
                        <p class="text-gray-400">{{ $applicant->applicant_id }}</p>
                        <div class="mt-6 space-y-2">
                             <a href="{{ Storage::url($applicant->cv_path) }}" class="block w-full text-center bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 px-4 rounded" download>Unduh CV</a>
                             <a href="{{ Storage::url($applicant->zip_path) }}" class="block w-full text-center bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 px-4 rounded" download>Unduh Berkas (.zip)</a>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h4 class="text-xl font-semibold border-b border-gray-700 pb-2 mb-3">Informasi Lamaran</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div><strong class="text-gray-400 block">Perusahaan:</strong> {{ $applicant->company->name ?? 'N/A' }}</div>
                                <div><strong class="text-gray-400 block">Posisi:</strong> {{ $applicant->position->name ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xl font-semibold border-b border-gray-700 pb-2 mb-3">Kontak & Personal</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div><strong class="text-gray-400 block">Email:</strong> {{ $applicant->email }}</div>
                                <div><strong class="text-gray-400 block">Telepon:</strong> {{ $applicant->phone_number }}</div>
                                <div class="col-span-2"><strong class="text-gray-400 block">Alamat:</strong> {{ $applicant->address }}</div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xl font-semibold border-b border-gray-700 pb-2 mb-3">Pendidikan</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div><strong class="text-gray-400 block">Institusi:</strong> {{ $applicant->school_name }}</div>
                                <div><strong class="text-gray-400 block">Jurusan:</strong> {{ $applicant->major }}</div>
                                <div><strong class="text-gray-400 block">Pendidikan Terakhir:</strong> {{ $applicant->last_education }}</div>
                                <div><strong class="text-gray-400 block">Tahun Lulus:</strong> {{ $applicant->graduation_year }}</div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xl font-semibold border-b border-gray-700 pb-2 mb-3">Keterampilan & Portfolio</h4>
                            <div class="text-sm space-y-3">
                                <div>
                                    <strong class="text-gray-400 block mb-1">Keterampilan:</strong>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $applicant->skills) as $skill)
                                            <span class="bg-gray-700 text-gray-300 text-xs font-semibold px-2.5 py-0.5 rounded">{{ trim($skill) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @if($applicant->portfolio_link)
                                    <div><strong class="text-gray-400 block">Portfolio:</strong> <a href="{{ $applicant->portfolio_link }}" class="text-sky-400 hover:underline" target="_blank">{{ $applicant->portfolio_link }}</a></div>
                                @elseif($applicant->portfolio_file_path)
                                     <div><strong class="text-gray-400 block">Portfolio:</strong> <a href="{{ Storage::url($applicant->portfolio_file_path) }}" class="text-sky-400 hover:underline" download>Unduh File Portfolio</a></div>
                                @endif
                            </div>
                        </div>
                         <div>
                            <h4 class="text-xl font-semibold border-b border-gray-700 pb-2 mb-3">Ringkasan Diri</h4>
                            <p class="text-sm text-gray-300">{{ $applicant->personal_summary }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
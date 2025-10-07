@extends('layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="card-title">Formulir Pendaftaran Pelamar</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Domisili (Kota)</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            </div>

            <div class="row">
                 <div class="col-md-6 mb-3">
                    <label for="major" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="major" name="major" value="{{ old('major', 'Rekayasa Perangkat Lunak') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="graduation_year" class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year') }}" placeholder="Contoh: 2025" required>
                </div>
            </div>
             <div class="mb-3">
                <label for="student_id_number" class="form-label">NIS/NISN (Opsional)</label>
                <input type="text" class="form-control" id="student_id_number" name="student_id_number" value="{{ old('student_id_number') }}">
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Keterampilan (Pisahkan dengan koma)</label>
                <textarea class="form-control" id="skills" name="skills" rows="3" required>{{ old('skills') }}</textarea>
            </div>
             <div class="mb-3">
                <label for="portfolio_link" class="form-label">Link Portfolio/GitHub (Opsional)</label>
                <input type="url" class="form-control" id="portfolio_link" name="portfolio_link" value="{{ old('portfolio_link') }}">
            </div>
            <div class="mb-3">
                <label for="personal_summary" class="form-label">Ringkasan Diri</label>
                <textarea class="form-control" id="personal_summary" name="personal_summary" rows="3" required>{{ old('personal_summary') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                     <label for="photo" class="form-label">Foto Diri (JPG/PNG, max 2MB)</label>
                     <input type="file" class="form-control" id="photo" name="photo" required>
                </div>
                 <div class="col-md-6 mb-3">
                     <label for="cv" class="form-label">CV (PDF, max 2MB)</label>
                     <input type="file" class="form-control" id="cv" name="cv" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="company_id" class="form-label">Perusahaan yang Dituju</label>
                <select class="form-select" id="company_id" name="company_id" required>
                    <option value="">-- Pilih Perusahaan --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid">
                 <button type="submit" class="btn btn-primary btn-lg">Kirim Lamaran & Dapatkan QR Code</button>
            </div>
        </form>
    </div>
</div>
@endsection
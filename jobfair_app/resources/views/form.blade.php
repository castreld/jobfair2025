@extends('layout')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('applicant.lookup') }}" method="POST">
            @csrf
            <h5 class="card-title">Sudah Mendaftar?</h5>
            <p class="card-text">Masukan nomor ID pendaftaran (Contoh: JF-123456) atau email anda untuk melihat kembali QR Code.</p>
            <div class="input-group">
                <input type="text" class="form-control" name="identifier" placeholder="ID Pendaftaran atau Email" required>
                <button class="btn btn-outline-secondary" type="submit">Cari Data</button>
            </div>
        </form>
    </div>
</div>

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
                <label for="address" class="form-label">Domisili</label>
                <select class="form-select" id="address" name="address" required>
                    <option value="">-- Pilih Domisili --</option>
                    <option value="Kota Cimahi" {{ old('address') == 'Kota Cimahi' ? 'selected' : '' }}>Kota Cimahi</option>
                    <option value="Kota Bandung" {{ old('address') == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung</option>
                    <option value="Kabupaten Bandung" {{ old('address') == 'Kabupaten Bandung' ? 'selected' : '' }}>Kabupaten Bandung</option>
                    <option value="Kabupaten Bandung Barat" {{ old('address') == 'Kabupaten Bandung Barat' ? 'selected' : '' }}>Kabupaten Bandung Barat</option>
                    <option value="Lainnya" {{ old('address') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="mb-3" id="address_other_wrapper" style="display: none;">
                <label for="address_other" class="form-label">Sebutkan Domisili Anda</label>
                <input type="text" class="form-control" id="address_other" name="address_other" value="{{ old('address_other') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="last_education" class="form-label">Pendidikan Terakhir</label>
                <select class="form-select" id="last_education" name="last_education" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="SMA/SMK Sederajat" {{ old('last_education') == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                    <option value="D3" {{ old('last_education') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="D4" {{ old('last_education') == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="S1" {{ old('last_education') == 'S1' ? 'selected' : '' }}>S1</option>
                </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="school_name" class="form-label">Nama Sekolah/Universitas</label>
                    <input type="text" class="form-control" id="school_name" name="school_name" value="{{ old('school_name') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="major" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="graduation_year" class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year') }}" placeholder="Contoh: 2025" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="skills" class="form-label">Keterampilan (Pisahkan dengan koma)</label>
                <textarea class="form-control" id="skills" name="skills" rows="3" required>{{ old('skills') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Portfolio (Opsional)</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="portfolio_type" id="portfolio_type_link" value="link" {{ old('portfolio_type', 'link') == 'link' ? 'checked' : '' }}>
                    <label class="form-check-label" for="portfolio_type_link">
                        Link (GitHub, LinkedIn, Website Pribadi, dll.)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="portfolio_type" id="portfolio_type_file" value="file" {{ old('portfolio_type') == 'file' ? 'checked' : '' }}>
                    <label class="form-check-label" for="portfolio_type_file">
                        Unggah File (PDF, max 10MB)
                    </label>
                </div>
            </div>
            <div class="mb-3" id="portfolio_link_wrapper">
                <label for="portfolio_link" class="form-label visually-hidden">Link Portfolio</label>
                <input type="url" class="form-control" id="portfolio_link" name="portfolio_link" value="{{ old('portfolio_link') }}" placeholder="https://github.com/...">
            </div>
            <div class="mb-3" id="portfolio_file_wrapper" style="display: none;">
                <label for="portfolio_file" class="form-label visually-hidden">File Portfolio</label>
                <input type="file" class="form-control" id="portfolio_file" name="portfolio_file" accept="application/pdf">
            </div>
            <div class="mb-3">
                <label for="personal_summary" class="form-label">Ringkasan Diri</label>
                <textarea class="form-control" id="personal_summary" name="personal_summary" rows="3" required>{{ old('personal_summary') }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">Foto Diri (JPG/PNG, max 10MB)</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cv" class="form-label">CV (PDF, max 10MB)</label>
                    <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf" required>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addressSelect = document.getElementById('address');
        const addressOtherWrapper = document.getElementById('address_other_wrapper');
        const addressOtherInput = document.getElementById('address_other');

        function toggleAddressOther() {
            if (addressSelect.value === 'Lainnya') {
                addressOtherWrapper.style.display = 'block';
                addressOtherInput.required = true;
            } else {
                addressOtherWrapper.style.display = 'none';
                addressOtherInput.required = false;
            }
        }
        toggleAddressOther();
        addressSelect.addEventListener('change', toggleAddressOther);

        const portfolioTypeRadios = document.querySelectorAll('input[name="portfolio_type"]');
        const linkWrapper = document.getElementById('portfolio_link_wrapper');
        const fileWrapper = document.getElementById('portfolio_file_wrapper');

        function togglePortfolioInputs() {
            const selectedType = document.querySelector('input[name="portfolio_type"]:checked').value;
            if (selectedType === 'link') {
                linkWrapper.style.display = 'block';
                fileWrapper.style.display = 'none';
            } else {
                linkWrapper.style.display = 'none';
                fileWrapper.style.display = 'block';
            }
        }

        portfolioTypeRadios.forEach(radio => radio.addEventListener('change', togglePortfolioInputs));

        togglePortfolioInputs();
    });
</script>
@endpush
@extends('layout')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

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
                    <select class="form-select" id="major" name="major" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->name }}" {{ old('major') == $major->name ? 'selected' : '' }}>
                                {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
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
            <div class="mb-3">
                <label for="position_id" class="form-label">Posisi yang Dilamar</label>
                <select class="form-select" id="position_id" name="position_id" required disabled>
                    <option value="">-- Pilih Perusahaan Terlebih Dahulu --</option>
                </select>
            </div>

            <div class="alert alert-info" id="position-requirements" style="display: none;"></div>
            <div class="alert alert-danger" id="qualification-warning" style="display: none;">
                <strong>Perhatian!</strong> Anda tidak memenuhi kriteria untuk posisi ini. Mohon periksa kembali Pendidikan dan Jurusan Anda.
            </div>

            <div class="d-grid">
                <button type="submit" id="submit-button" class="btn btn-primary btn-lg">Kirim Lamaran & Dapatkan QR Code</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    $('#major').select2({
        theme: 'bootstrap-5'
    });

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

    const companySelect = document.getElementById('company_id');
    const positionSelect = document.getElementById('position_id');
    const educationSelect = document.getElementById('last_education');
    const majorSelect = document.getElementById('major');
    const requirementsBox = document.getElementById('position-requirements');
    const warningBox = document.getElementById('qualification-warning');
    const submitButton = document.getElementById('submit-button');

    let allPositions = [];
    const educationLevels = {
        '': 0,
        'SMA/SMK Sederajat': 1,
        'D3': 2,
        'D4': 3,
        'S1': 3,
        'D4/S1': 3,
        'S2': 4
    };

    companySelect.addEventListener('change', function() {
        const companyId = this.value;
        positionSelect.innerHTML = '<option value="">-- Memuat Posisi --</option>';
        positionSelect.disabled = true;
        allPositions = [];
        validateQualifications();

        if (companyId) {
            fetch(`/positions/${companyId}`)
                .then(response => response.json())
                .then(data => {
                    allPositions = data;
                    positionSelect.innerHTML = '<option value="">-- Pilih Posisi --</option>';
                    data.forEach(position => {
                        const option = document.createElement('option');
                        option.value = position.id;
                        option.textContent = position.name;
                        positionSelect.appendChild(option);
                    });
                    positionSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching positions:', error);
                    positionSelect.innerHTML = '<option value="">-- Gagal Memuat --</option>';
                });
        } else {
            positionSelect.innerHTML = '<option value="">-- Pilih Perusahaan Terlebih Dahulu --</option>';
        }
    });

    positionSelect.addEventListener('change', validateQualifications);
    educationSelect.addEventListener('change', validateQualifications);
    majorSelect.addEventListener('change', validateQualifications);

    function validateQualifications() {
        requirementsBox.style.display = 'none';
        warningBox.style.display = 'none';
        submitButton.disabled = false;
        educationSelect.classList.remove('is-invalid');
        majorSelect.classList.remove('is-invalid');

        const positionId = positionSelect.value;
        if (!positionId) return;

        const selectedPosition = allPositions.find(p => p.id == positionId);
        if (!selectedPosition) return;

        const reqEducation = selectedPosition.minimum_education;
        const reqMajors = selectedPosition.majors || [];
        
        let requirementsHtml = '<strong>Kriteria Posisi:</strong><ul>';
        if (reqEducation) {
            requirementsHtml += `<li>Pendidikan Minimal: <strong>${reqEducation}</strong></li>`;
        } else {
            requirementsHtml += '<li>Pendidikan: <strong>Tidak ada minimal</strong></li>';
        }

        if (reqMajors.length > 0) {
            requirementsHtml += `<li>Jurusan: <strong>${reqMajors.map(m => m.name).join(', ')}</strong></li>`;
        } else {
            requirementsHtml += '<li>Jurusan: <strong>Semua jurusan</strong></li>';
        }
        requirementsHtml += '</ul>';
        requirementsBox.innerHTML = requirementsHtml;
        requirementsBox.style.display = 'block';

        const userEducation = educationSelect.value;
        const userMajor = majorSelect.value.trim().toLowerCase();
        
        const requiredLevel = reqEducation ? educationLevels[reqEducation] : 0;
        const userLevel = userEducation ? educationLevels[userEducation] : 0;
        const educationMatch = userLevel >= requiredLevel;

        let majorMatch = false;
        if (reqMajors.length === 0) {
            majorMatch = true;
        } else if (userMajor.length > 0) {
            majorMatch = reqMajors.some(major => 
                major.name.toLowerCase() === userMajor
            );
        }

        if (!educationMatch || !majorMatch) {
            warningBox.style.display = 'block';
            submitButton.disabled = true;

            if (!educationMatch) {
                educationSelect.classList.add('is-invalid');
            }
            if (!majorMatch && reqMajors.length > 0) {
                majorSelect.classList.add('is-invalid');
            }
        }
    }
});
</script>
@endpush
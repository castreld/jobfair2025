@extends('layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">Profil Pelamar (ID: {{ $applicant->applicant_id }})</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/' . $applicant->photo_path) }}" class="img-fluid rounded-circle mb-3" alt="Foto {{ $applicant->full_name }}" style="width: 150px; height: 150px; object-fit: cover;">
                
                <h4>{{ $applicant->full_name }}</h4>
                <p class="text-muted">{{ $applicant->major }} (Lulus {{ $applicant->graduation_year }})</p>
                <p class="text-muted">{{ $applicant->last_education }} - {{ $applicant->school_name }}</p>

                <div class="d-grid gap-2">
                    <a href="{{ asset('storage/' . $applicant->cv_path) }}" class="btn btn-outline-primary" target="_blank">Unduh CV (PDF)</a>
                    <a href="{{ asset('storage/' . $applicant->zip_path) }}" class="btn btn-primary" target="_blank">Unduh Semua Data (.zip)</a>
                </div>
            </div>
            <div class="col-md-8">
                <h5>Melamar di: <strong>{{ $applicant->company->name }}</strong></h5>
                <hr>
                
                <h5><strong>Ringkasan Diri</strong></h5>
                <p>{{ $applicant->personal_summary }}</p>

                <h5><strong>Keterampilan</strong></h5>
                <p>
                    @foreach(explode(',', $applicant->skills) as $skill)
                        <span class="badge bg-secondary">{{ trim($skill) }}</span>
                    @endforeach
                </p>
                
                <hr>
                
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> {{ $applicant->email }}</li>
                    <li><strong>Telepon:</strong> {{ $applicant->phone_number }}</li>
                    <li><strong>Domisili:</strong> {{ $applicant->address }}</li>

                    @if($applicant->portfolio_link)
                        <li>
                            <strong>Portfolio:</strong> 
                            <a href="{{ $applicant->portfolio_link }}" target="_blank">{{ $applicant->portfolio_link }}</a>
                        </li>
                    @elseif($applicant->portfolio_file_path)
                        <li>
                            <strong>Portfolio:</strong> 
                            <a href="{{ asset('storage/' . $applicant->portfolio_file_path) }}" target="_blank">Lihat Portfolio (PDF)</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
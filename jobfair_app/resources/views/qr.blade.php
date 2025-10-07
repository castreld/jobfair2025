@extends('layout')

@section('content')
<div class="card shadow-sm text-center">
    <div class="card-header">
        <h4 class="card-title">Pendaftaran Berhasil!</h4>
    </div>
    <div class="card-body">
        <p>Terima kasih, <strong>{{ $applicant->full_name }}</strong>. Data Anda telah kami terima.</p>
        <p>Silakan <strong>screenshot</strong> atau simpan QR Code di bawah ini. Tunjukkan QR Code ini kepada perwakilan perusahaan di lokasi job fair.</p>
        
        <div class="my-4">
            {!! QrCode::size(300)->generate(route('applicant.show', $applicant->uuid)) !!}
        </div>

        <p class="text-muted">QR Code ini adalah tiket digital Anda.</p>
        <a href="{{ route('applicant.create') }}" class="btn btn-secondary mt-3">Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection
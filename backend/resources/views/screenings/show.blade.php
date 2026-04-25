@extends('layout')

@section('content')

<style>
    .card { border-radius: 12px; }
    .alert-soft-success { background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .alert-soft-warning { background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
    .alert-soft-danger { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    .info-label { font-size: 0.875rem; color: #6b7280; margin-bottom: 2px; }
    .info-value { font-size: 1rem; color: #111827; font-weight: 500; }
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; color: white; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Detail Skrining</h3>
        <p class="text-secondary mb-0" style="font-size: 15px;">Rincian hasil pemeriksaan pasien</p>
    </div>
    <a href="/screenings" class="btn btn-outline-secondary px-3 py-2 rounded">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0 col-md-8">
    <div class="card-body p-4">

        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="info-label">Nama Pasien</p>
                <p class="info-value">{{ $screening->patient->name }}</p>
            </div>
            <div class="col-md-6">
                <p class="info-label">Body Mass Index (BMI)</p>
                <p class="info-value">{{ number_format($screening->bmi, 2) }}</p>
            </div>
        </div>

        @if($screening->risk_level == 'low')
            <div class="alert alert-soft-success rounded-3 p-3 mb-4">
                <div class="d-flex gap-3">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Risiko Rendah</h6>
                        <p class="mb-0" style="font-size: 14px;">Pertahankan gaya hidup sehat 👍</p>
                    </div>
                </div>
            </div>
        @elseif($screening->risk_level == 'medium')
            <div class="alert alert-soft-warning rounded-3 p-3 mb-4">
                <div class="d-flex gap-3">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Risiko Sedang</h6>
                        <p class="mb-0" style="font-size: 14px;">Mulai perbaiki pola makan & olahraga</p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-soft-danger rounded-3 p-3 mb-4">
                <div class="d-flex gap-3">
                    <i class="bi bi-shield-fill-exclamation fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Risiko Tinggi</h6>
                        <p class="mb-0" style="font-size: 14px;">Segera konsultasi ke tenaga kesehatan!</p>
                    </div>
                </div>
            </div>
        @endif

        <h6 class="fw-bold text-dark mt-4 mb-2">Rekomendasi Tindakan:</h6>
        <div class="bg-light p-3 rounded text-secondary" style="font-size: 14px;">
            @if($screening->risk_level == 'high')
                <i class="bi bi-dot text-danger"></i> Kurangi konsumsi gula<br>
                <i class="bi bi-dot text-danger"></i> Olahraga rutin<br>
                <i class="bi bi-dot text-danger"></i> Konsultasi ke dokter spesialis secepatnya
            @elseif($screening->risk_level == 'medium')
                <i class="bi bi-dot text-warning"></i> Perbaiki pola makan (kurangi karbohidrat berlebih)<br>
                <i class="bi bi-dot text-warning"></i> Mulai olahraga ringan secara teratur
            @else
                <i class="bi bi-dot text-success"></i> Pertahankan pola hidup sehat dan rajin beraktivitas
            @endif
        </div>

    </div>
</div>

@endsection
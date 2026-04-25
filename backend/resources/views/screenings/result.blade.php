@extends('layout')

@section('content')

<style>
    .card { border-radius: 12px; }
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; color: white; }
    
    .alert-soft-success { background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .alert-soft-warning { background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
    .alert-soft-danger { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

    /* Stepper CSS Modern */
    .stepper-wrapper { display: flex; justify-content: center; align-items: flex-start; margin-bottom: 2rem; }
    .step-item { display: flex; flex-direction: column; align-items: center; width: 100px; position: relative; z-index: 1; }
    .step-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px; margin-bottom: 8px; transition: all 0.2s; }
    .step-text { font-size: 13px; font-weight: 500; text-align: center; }
    
    .step-completed .step-circle { background-color: #10b981; color: white; }
    .step-completed .step-text { color: #10b981; font-weight: 600; }
    
    .step-active .step-circle { background-color: #2563eb; color: white; box-shadow: 0 0 0 4px #dbeafe; }
    .step-active .step-text { color: #111827; font-weight: 600; }

    .step-line { flex: 1; max-width: 60px; height: 2px; margin-top: 20px; }
    .line-completed { background-color: #10b981; }
</style>

<div class="text-center mb-4">
    <h3 class="fw-bold mb-1 text-dark">Skrining Diabetes</h3>
    <p class="text-secondary" style="font-size: 15px;">Formulir skrining risiko diabetes mellitus</p>
</div>

<div class="stepper-wrapper">
    <div class="step-item step-completed">
        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
        <div class="step-text">Data Pasien</div>
    </div>
    <div class="step-line line-completed"></div>
    
    <div class="step-item step-completed">
        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
        <div class="step-text">Pemeriksaan</div>
    </div>
    <div class="step-line line-completed"></div>
    
    <div class="step-item step-active">
        <div class="step-circle">3</div>
        <div class="step-text">Hasil</div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4 col-md-8 mx-auto">

    <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Kesimpulan Skrining</h5>

    @if($data->risk_level == 'low')
        <div class="alert alert-soft-success rounded-3 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="bi bi-check-circle-fill me-2"></i>Kategori Risiko: RENDAH</h6>
            <p class="mb-0 ms-4" style="font-size: 14px;">Kondisi aman. Pertahankan pola hidup sehat.</p>
        </div>
    @elseif($data->risk_level == 'medium')
        <div class="alert alert-soft-warning rounded-3 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Kategori Risiko: SEDANG</h6>
            <p class="mb-0 ms-4" style="font-size: 14px;">Mulai perbaiki pola makan & olahraga rutin.</p>
        </div>
    @else
        <div class="alert alert-soft-danger rounded-3 p-3 mb-4">
            <h6 class="fw-bold mb-1"><i class="bi bi-shield-fill-exclamation me-2"></i>Kategori Risiko: TINGGI</h6>
            <p class="mb-0 ms-4" style="font-size: 14px;">Segera konsultasi ke tenaga medis untuk pemeriksaan lanjut.</p>
        </div>
    @endif

    <div class="bg-light p-4 rounded-3 mb-4">
        <div class="row g-3 text-secondary" style="font-size: 14px;">
            <div class="col-6">
                <span class="d-block mb-1">Nama Pasien:</span>
                <strong class="text-dark">{{ $data->patient->name }}</strong>
            </div>
            <div class="col-6">
                <span class="d-block mb-1">Body Mass Index (BMI):</span>
                <strong class="text-dark">{{ number_format($data->bmi, 2) }}</strong>
            </div>
            <div class="col-6">
                <span class="d-block mb-1">Gula Darah:</span>
                <strong class="text-dark">{{ $data->blood_sugar }} <small>mg/dL</small></strong>
            </div>
            <div class="col-6">
                <span class="d-block mb-1">Tekanan Darah:</span>
                <strong class="text-dark">{{ $data->blood_pressure }}</strong>
            </div>
        </div>
    </div>

    <h6 class="fw-bold mt-2 mb-3 text-dark">Rekomendasi Tindakan:</h6>
    <ul class="text-secondary" style="font-size: 14px; line-height: 1.8;">
        @if($data->risk_level == 'high')
            <li>Konsultasi ke dokter/fasilitas kesehatan terdekat</li>
            <li>Kurangi konsumsi gula harian secara ketat</li>
            <li>Rutin melakukan olahraga sesuai anjuran medis</li>
        @elseif($data->risk_level == 'medium')
            <li>Perbaiki pola makan (kurangi karbohidrat berlebih)</li>
            <li>Lakukan olahraga ringan minimal 30 menit sehari</li>
        @else
            <li>Pertahankan gaya hidup sehat dan asupan gizi seimbang</li>
        @endif
    </ul>

    <div class="d-flex flex-column flex-md-row gap-3 mt-4 pt-3 border-top">
        <a href="/screenings/{{ $data->id }}/pdf" class="btn btn-outline-secondary px-4 py-2 flex-fill">
            <i class="bi bi-printer me-1"></i> Cetak Hasil
        </a>
        <a href="/screenings/select" class="btn bg-blue-600 px-4 py-2 flex-fill text-center">
            Skrining Pasien Baru <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

</div>

@endsection
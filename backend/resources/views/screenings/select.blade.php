@extends('layout')

@section('content')

<style>
    .card { border-radius: 12px; }
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; color: white; }
    
    /* Stepper CSS Modern */
    .stepper-wrapper { display: flex; justify-content: center; align-items: flex-start; margin-bottom: 2rem; }
    .step-item { display: flex; flex-direction: column; align-items: center; width: 100px; position: relative; z-index: 1; }
    .step-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px; margin-bottom: 8px; transition: all 0.2s; }
    .step-text { font-size: 13px; font-weight: 500; text-align: center; }
    
    .step-active .step-circle { background-color: #2563eb; color: white; box-shadow: 0 0 0 4px #dbeafe; }
    .step-active .step-text { color: #111827; font-weight: 600; }
    
    .step-inactive .step-circle { background-color: #f3f4f6; color: #9ca3af; border: 2px solid #e5e7eb; }
    .step-inactive .step-text { color: #9ca3af; }

    .step-line { flex: 1; max-width: 60px; height: 2px; background-color: #e5e7eb; margin-top: 20px; }
</style>

<div class="text-center mb-4">
    <h3 class="fw-bold mb-1 text-dark">Skrining Diabetes</h3>
    <p class="text-secondary" style="font-size: 15px;">Formulir skrining risiko diabetes mellitus</p>
</div>

<div class="stepper-wrapper">
    <div class="step-item step-active">
        <div class="step-circle">1</div>
        <div class="step-text">Data Pasien</div>
    </div>
    <div class="step-line"></div>
    
    <div class="step-item step-inactive">
        <div class="step-circle">2</div>
        <div class="step-text">Pemeriksaan</div>
    </div>
    <div class="step-line"></div>
    
    <div class="step-item step-inactive">
        <div class="step-circle">3</div>
        <div class="step-text">Hasil</div>
    </div>
</div>

<div class="card p-4 shadow-sm border-0 mx-auto" style="max-width:500px;">
    <form id="formSelect">
        <div class="mb-4">
            <label class="form-label fw-semibold text-dark" style="font-size: 14px;">Pilih Pasien</label>
            <select id="patient_id" class="form-select text-secondary" style="padding: 12px 16px;">
                <option value="" selected disabled>-- Pilih data pasien --</option>
                @foreach($patients as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }} ({{ $p->age ?? '-' }} tahun)
                    </option>
                @endforeach
            </select>
            <div class="form-text mt-2"><i class="bi bi-info-circle"></i> Pastikan pasien sudah terdaftar di menu Data Pasien.</div>
        </div>

        <button type="button" onclick="goNext()" class="btn bg-blue-600 w-100 py-2 fw-medium rounded">
            Lanjutkan ke Pemeriksaan <i class="bi bi-arrow-right ms-1"></i>
        </button>
    </form>
</div>

<script>
function goNext() {
    let id = document.getElementById('patient_id').value;

    if (!id) {
        alert('Silakan pilih pasien terlebih dahulu!');
        return;
    }

    // Redirect ke step 2
    window.location.href = '/screenings/form/' + id;
}
</script>

@endsection
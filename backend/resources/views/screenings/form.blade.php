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
    
    .step-completed .step-circle { background-color: #10b981; color: white; }
    .step-completed .step-text { color: #10b981; font-weight: 600; }
    
    .step-active .step-circle { background-color: #2563eb; color: white; box-shadow: 0 0 0 4px #dbeafe; }
    .step-active .step-text { color: #111827; font-weight: 600; }
    
    .step-inactive .step-circle { background-color: #f3f4f6; color: #9ca3af; border: 2px solid #e5e7eb; }
    .step-inactive .step-text { color: #9ca3af; }

    .step-line { flex: 1; max-width: 60px; height: 2px; margin-top: 20px; }
    .line-completed { background-color: #10b981; }
    .line-inactive { background-color: #e5e7eb; }

    /* Form Customizations */
    .form-label { font-size: 13.5px; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .input-group-text { background-color: #f9fafb; color: #6b7280; font-size: 14px; border-color: #e5e7eb; }
    .form-control { border-color: #e5e7eb; padding: 10px 14px; font-size: 14px; }
    .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    
    .section-title { font-size: 15px; font-weight: 700; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 8px; margin-bottom: 16px; margin-top: 24px; }
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
    
    <div class="step-item step-active">
        <div class="step-circle">2</div>
        <div class="step-text">Pemeriksaan</div>
    </div>
    <div class="step-line line-inactive"></div>
    
    <div class="step-item step-inactive">
        <div class="step-circle">3</div>
        <div class="step-text">Hasil</div>
    </div>
</div>

<div class="card p-4 shadow-sm border-0 col-lg-8 mx-auto mb-5">

    <div class="alert bg-light border text-dark rounded-3 d-flex align-items-center mb-4">
        <i class="bi bi-person-badge fs-4 text-primary me-3"></i>
        <div>
            <span class="d-block text-secondary" style="font-size: 12px;">Pasien Terpilih</span>
            <strong class="mb-0">{{ $patient->name }}</strong>
        </div>
    </div>

    <form action="/screenings/process" method="POST">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

        <h5 class="section-title">Antropometri</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Berat Badan</label>
                <div class="input-group">
                    <input type="number" step="0.1" name="weight" class="form-control" placeholder="0" required>
                    <span class="input-group-text">kg</span>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tinggi Badan</label>
                <div class="input-group">
                    <input type="number" step="0.1" name="height" class="form-control" placeholder="0" required>
                    <span class="input-group-text">cm</span>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Lingkar Pinggang</label>
                <div class="input-group">
                    <input type="number" step="0.1" name="waist_circumference" class="form-control" placeholder="0" required>
                    <span class="input-group-text">cm</span>
                </div>
            </div>
        </div>

        <h5 class="section-title">Pemeriksaan Klinis</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Tekanan Darah (Sistolik / Diastolik)</label>
                <div class="input-group">
                    <input type="number" name="sistolik" class="form-control" placeholder="Sistolik" required>
                    <span class="input-group-text">/</span>
                    <input type="number" name="diastolik" class="form-control" placeholder="Diastolik" required>
                    <span class="input-group-text">mmHg</span>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Gula Darah</label>
                <div class="input-group">
                    <input type="number" name="blood_sugar" class="form-control" placeholder="0" required>
                    <span class="input-group-text">mg/dL</span>
                </div>
            </div>
        </div>

        <h5 class="section-title">Pola Hidup & Faktor Risiko</h5>
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label d-block">Aktivitas Fisik (Olahraga rutin)</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="physical_activity" id="fisik_ya" value="1" required>
                    <label class="btn btn-outline-primary" for="fisik_ya">Ya, Aktif</label>

                    <input type="radio" class="btn-check" name="physical_activity" id="fisik_tidak" value="0" required>
                    <label class="btn btn-outline-secondary" for="fisik_tidak">Tidak</label>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label d-block">Riwayat Diabetes Keluarga</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="family_history" id="riwayat_ya" value="1" required>
                    <label class="btn btn-outline-danger" for="riwayat_ya">Ya, Ada</label>

                    <input type="radio" class="btn-check" name="family_history" id="riwayat_tidak" value="0" required>
                    <label class="btn btn-outline-secondary" for="riwayat_tidak">Tidak Ada</label>
                </div>
            </div>
        </div>

        <hr class="my-4 text-secondary">

        <div class="d-flex justify-content-between align-items-center">
            <a href="/screenings/select" class="btn btn-outline-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <button type="submit" class="btn bg-blue-600 px-4 py-2">
                Hitung Risiko <i class="bi bi-calculator ms-1"></i>
            </button>
        </div>

    </form>
</div>

@endsection
@extends('layout')

@section('content')

<style>
    .card { border-radius: 12px; }
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; color: white; }
    
    .form-label { font-size: 13.5px; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .input-group-text { background-color: #f9fafb; color: #6b7280; font-size: 14px; border-color: #e5e7eb; }
    .form-control, .form-select { border-color: #e5e7eb; padding: 10px 14px; font-size: 14px; }
    .form-control:focus, .form-select:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    
    .section-title { font-size: 15px; font-weight: 700; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 8px; margin-bottom: 16px; margin-top: 24px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Tambah Skrining Baru</h3>
        <p class="text-secondary mb-0" style="font-size: 15px;">Masukkan data hasil pemeriksaan pasien</p>
    </div>
    <a href="/screenings" class="btn btn-outline-secondary px-3 py-2 rounded">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card p-4 shadow-sm border-0 col-lg-8 mx-auto mb-5">
    <form action="/screenings" method="POST">
        @csrf

        <h5 class="section-title mt-0">Informasi Pasien</h5>
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Pilih Pasien</label>
                <select name="patient_id" class="form-select" required>
                    <option value="" selected disabled>-- Pilih pasien terdaftar --</option>
                    @foreach($patients as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <label class="form-label">Umur</label>
                <div class="input-group">
                    <input type="number" name="age" class="form-control" placeholder="0" required>
                    <span class="input-group-text">Tahun</span>
                </div>
            </div>
        </div>

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
                <label class="form-label">Gula Darah</label>
                <div class="input-group">
                    <input type="number" name="blood_sugar" class="form-control" placeholder="0" required>
                    <span class="input-group-text">mg/dL</span>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tekanan Darah</label>
                <div class="input-group">
                    <input type="text" name="blood_pressure" class="form-control" placeholder="Contoh: 120/80" required>
                    <span class="input-group-text">mmHg</span>
                </div>
            </div>
        </div>

        <h5 class="section-title">Pola Hidup & Faktor Risiko</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Aktivitas Fisik (Olahraga)</label>
                <select name="physical_activity" class="form-select" required>
                    <option value="" selected disabled>-- Pilih aktivitas --</option>
                    <option value="1">Aktif / Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Riwayat Diabetes Keluarga</label>
                <select name="family_history" class="form-select" required>
                    <option value="" selected disabled>-- Pilih riwayat --</option>
                    <option value="1">Ada</option>
                    <option value="0">Tidak Ada</option>
                </select>
            </div>
        </div>

        <hr class="my-4 text-secondary">

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn bg-blue-600 px-4 py-2 fw-medium">
                Simpan Skrining <i class="bi bi-save ms-1"></i>
            </button>
        </div>

    </form>
</div>

@endsection
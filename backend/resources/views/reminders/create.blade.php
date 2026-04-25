@extends('layout')

@section('content')

<style>
    .card-ui { background: white; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .btn-blue { background-color: #2563eb; color: white; font-weight: 500; border-radius: 6px; padding: 8px 16px; border: none; transition: background 0.2s; }
    .btn-blue:hover { background-color: #1d4ed8; color: white;}
    .btn-outline-ui { border: 1px solid #e5e7eb; background: white; color: #374151; padding: 8px 16px; border-radius: 6px; font-weight: 500; text-decoration: none; }
    .btn-outline-ui:hover { background-color: #f3f4f6; color: #111827; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold text-dark m-0" style="font-size: 24px;">Tambah Pengingat Baru</h1>
        <p class="text-secondary mt-1" style="font-size: 15px;">Form halaman tambah pengingat obat</p>
    </div>
    <a href="/reminders" class="btn-outline-ui">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card-ui p-4 col-lg-8 mx-auto">
    <form action="/reminders" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Pasien</label>
                <select name="user_id" class="form-select" required>
                    <option value="" selected disabled>Pilih pasien...</option>
                    @if(isset($patients))
                        @foreach($patients as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size: 13px;">Nama Obat</label>
                <input type="text" name="medicine_name" class="form-control" placeholder="Contoh: Metformin" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size: 13px;">Jenis Obat</label>
                <select name="medicine_type" class="form-select" required>
                    <option value="Tablet">Tablet</option>
                    <option value="Kapsul">Kapsul</option>
                    <option value="Sirup">Sirup</option>
                    <option value="Injeksi">Injeksi (Insulin)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size: 13px;">Dosis (Contoh: 500mg)</label>
                <input type="text" name="dosage" class="form-control" placeholder="Contoh: 500mg" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size: 13px;">Frekuensi</label>
                <select name="frequency" class="form-select" required>
                    <option value="" selected disabled>Pilih frekuensi...</option>
                    <option value="1x Sehari">1x Sehari</option>
                    <option value="2x Sehari">2x Sehari</option>
                    <option value="3x Sehari">3x Sehari</option>
                    <option value="Sesuai Kebutuhan">Sesuai Kebutuhan</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size: 13px;">Jam Minum (Waktu)</label>
                <input type="time" name="time" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size: 13px;">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size: 13px;">Tanggal Selesai</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>
        
        <hr class="mt-4 mb-3">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn-blue px-4">Simpan Pengingat</button>
        </div>
    </form>
</div>

@endsection
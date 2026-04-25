@extends('layout')

@section('content')

<style>
    .text-gray-500 { color: #6b7280; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-900 { color: #111827; }
    
    .bg-blue-50 { background-color: #eff6ff; }
    .bg-blue-100 { background-color: #dbeafe !important; }
    .text-blue-600 { color: #2563eb !important; }
    
    .bg-green-100 { background-color: #d1fae5 !important; }
    .text-green-600 { color: #16a34a !important; }
    
    .bg-yellow-100 { background-color: #fef08a !important; }
    .text-yellow-600 { color: #ca8a04 !important; }

    .bg-gray-100 { background-color: #f3f4f6 !important; }

    .card-ui { background: white; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .card-hover:hover { border-color: #93c5fd; background-color: #eff6ff; transition: all 0.2s ease; }
    
    .btn-blue { background-color: #2563eb; color: white; font-weight: 500; border-radius: 6px; padding: 8px 16px; border: none; transition: background 0.2s; }
    .btn-blue:hover { background-color: #1d4ed8; color: white;}
    .btn-outline-ui { border: 1px solid #e5e7eb; background: white; color: #374151; padding: 6px 12px; border-radius: 6px; font-weight: 500; transition: background 0.2s; font-size: 13px;}
    .btn-outline-ui:hover { background-color: #f3f4f6; }

    .badge-ui { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; background-color: #2563eb; color: white;}
    
    .table-ui th { font-weight: 600; color: #4b5563; font-size: 0.875rem; border-bottom: 1px solid #e5e7eb; padding: 12px 16px;}
    .table-ui td { font-size: 0.875rem; color: #111827; vertical-align: middle; border-bottom: 1px solid #f3f4f6; padding: 12px 16px;}
</style>

@php
    $activeCount = count($data);
    $avgKepatuhan = 85; 
@endphp

<div class="container-fluid p-0">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gray-900 m-0" style="font-size: 30px;">Pengingat Obat</h1>
            <p class="text-gray-500 mt-1" style="font-size: 15px;">Kelola jadwal pengingat konsumsi obat pasien</p>
        </div>
        <button class="btn-blue d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addReminderModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Tambah Pengingat
        </button>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Pengingat Aktif</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $activeCount }}</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-3"><i class="bi bi-bell text-blue-600 fs-5"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Rata-rata Kepatuhan</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $avgKepatuhan }}%</p>
                    </div>
                    <div class="bg-green-100 p-2 rounded-3"><i class="bi bi-check-circle text-green-600 fs-5"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Pengingat Hari Ini</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $activeCount }}</p>
                    </div>
                    <div class="bg-yellow-100 p-2 rounded-3"><i class="bi bi-clock text-yellow-600 fs-5"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Selesai</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">0</p>
                    </div>
                    <div class="bg-gray-100 p-2 rounded-3"><i class="bi bi-x-circle text-gray-600 fs-5"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-ui mb-4">
        <div class="p-4 border-bottom border-gray-200">
            <h3 class="m-0 text-gray-900 fw-bold" style="font-size: 18px;">Pengingat Aktif</h3>
        </div>
        <div class="p-4">
            <div class="d-flex flex-column gap-3">
                @forelse($data as $r)
                <div class="card-ui card-hover p-4 border-gray-200">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <h3 class="m-0 fw-medium text-gray-900" style="font-size: 16px;">{{ $r->patient->name ?? 'Pasien Tidak Diketahui' }}</h3>
                                <span class="badge-ui">aktif</span>
                            </div>
                            
                            <div class="row g-3 text-sm mb-3">
                                <div class="col-6 col-md-3">
                                    <p class="text-gray-600 m-0 mb-1" style="font-size: 13px;">Obat</p>
                                    <p class="text-gray-900 fw-medium m-0">{{ $r->medicine_name }} ({{ $r->medicine_type }})</p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-gray-600 m-0 mb-1" style="font-size: 13px;">Dosis</p>
                                    <p class="text-gray-900 fw-medium m-0">{{ $r->dosage }}</p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-gray-600 m-0 mb-1" style="font-size: 13px;">Frekuensi</p>
                                    <p class="text-gray-900 fw-medium m-0">{{ $r->frequency }}</p>
                                </div>
                                <div class="col-6 col-md-3">
                                    <p class="text-gray-600 m-0 mb-1" style="font-size: 13px;">Jam Minum</p>
                                    <p class="text-gray-900 fw-medium m-0">{{ \Carbon\Carbon::parse($r->time)->format('H:i') }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2 mt-2" style="font-size: 13px;">
                                <span class="text-gray-600">Periode: {{ $r->start_date }} s/d {{ $r->end_date }}</span>
                                <span class="text-gray-500">•</span>
                                <span class="fw-medium text-green-600">Kepatuhan: Menunggu data</span>
                            </div>
                        </div>

                        <div class="ms-md-4 mt-3 mt-md-0">
                            <button class="btn-outline-ui d-flex align-items-center gap-2" onclick="alert('Pengingat dikirim ke pasien {{ $r->patient->name ?? '' }} untuk obat {{ $r->medicine_name }}')">
                                <i class="bi bi-bell"></i> Kirim Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-gray-500">
                    Belum ada pengingat aktif
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addReminderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark">Tambah Pengingat Obat Baru</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Atur jadwal pengingat konsumsi obat untuk pasien</p>
                </div>
                <button type="button" class="btn-close mb-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/reminders" method="POST">
                @csrf
                <div class="modal-body pt-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Pasien</label>
                            <select name="user_id" class="form-select" required>
                                <option value="" selected disabled>Pilih pasien...</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
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
                            <label class="form-label fw-semibold" style="font-size: 13px;">Dosis (Contoh: 500mg, 2 Sendok)</label>
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
                </div>
                
                <div class="modal-footer border-top-0 pt-0 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-blue flex-fill">Simpan Pengingat</button>
                    <button type="button" class="btn-outline-ui flex-fill text-center m-0" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
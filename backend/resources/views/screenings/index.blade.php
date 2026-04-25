@extends('layout')

@section('content')

<style>
    .bg-blue-600 { background-color: #2563eb !important; color: white; border: none; }
    .bg-blue-600:hover { background-color: #1d4ed8 !important; color: white; }
    
    .badge-soft-red { background-color: #fee2e2; color: #b91c1c; font-weight: 500; }
    .badge-soft-yellow { background-color: #fef3c7; color: #b45309; font-weight: 500; }
    .badge-soft-green { background-color: #d1fae5; color: #047857; font-weight: 500; }
    
    .card { border-radius: 12px; }
    .table th { font-weight: 600; color: #4b5563; font-size: 0.875rem; }
    .table td { font-size: 0.875rem; color: #1f2937; vertical-align: middle; }
    
    .btn-ghost { background: transparent; border: none; padding: 6px 10px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
    .btn-ghost:hover { background: #f3f4f6; }
</style>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Data Skrining</h3>
        <p class="text-secondary mb-0" style="font-size: 15px;">Kelola riwayat pemeriksaan diabetes pasien</p>
    </div>

    <a href="/screenings/select" class="btn bg-blue-600 px-3 py-2 d-flex align-items-center gap-2 rounded text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Tambah Skrining
    </a>
</div>

<div class="card border-0 shadow-sm p-0 mb-4">
    <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-dark mb-0">Riwayat Skrining Terbaru</h6>
        <span class="badge bg-light text-secondary border px-2 py-1">Total: {{ count($data) }}</span>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th class="border-0 px-4 py-3">Pasien</th>
                        <th class="border-0 py-3">BMI</th>
                        <th class="border-0 py-3">Gula Darah</th>
                        <th class="border-0 py-3">Risiko</th>
                        <th class="border-0 px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                @forelse($data as $s)
                <tr>
                    <td class="px-4 py-3 fw-medium text-dark">{{ $s->patient->name ?? '-' }}</td>
                    <td class="py-3 text-secondary">{{ number_format($s->bmi, 2) }}</td>
                    <td class="py-3 text-secondary">{{ $s->blood_sugar }} <small>mg/dL</small></td>
                    <td class="py-3">
                        @if(strtolower($s->risk_level) == 'low')
                            <span class="badge badge-soft-green px-3 py-2 rounded-pill">Rendah</span>
                        @elseif(strtolower($s->risk_level) == 'medium')
                            <span class="badge badge-soft-yellow px-3 py-2 rounded-pill">Sedang</span>
                        @else
                            <span class="badge badge-soft-red px-3 py-2 rounded-pill">Tinggi</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="d-flex justify-content-end gap-1">
                            <a href="/screenings/{{ $s->id }}" class="btn-ghost text-primary" title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            
                            <a href="/screenings/{{ $s->id }}/pdf" class="btn-ghost text-danger" title="Unduh PDF">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M12 18v-6"/><path d="m9 15 3 3 3-3"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="9" x2="15" y1="9" y2="9"/><line x1="9" x2="15" y1="15" y2="15"/></svg>
                            Belum ada data skrining
                        </div>
                    </td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@extends('layout')

@section('content')

<style>
    /* Base styling */
    .text-gray-500 { color: #6b7280; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-700 { color: #374151; }
    .text-gray-900 { color: #111827; }
    .bg-gray-50 { background-color: #f9fafb; }
    .bg-gray-100 { background-color: #f3f4f6; }
    .border-gray-100 { border-color: #f3f4f6; }
    .border-gray-200 { border-color: #e5e7eb; }

    /* Red Theme */
    .bg-red-50 { background-color: #fef2f2 !important; }
    .bg-red-200 { background-color: #fecaca !important; }
    .border-red-200 { border-color: #fecaca !important; }
    .text-red-600 { color: #dc2626 !important; }
    .text-red-700 { color: #b91c1c !important; }
    .text-red-900 { color: #7f1d1d !important; }

    /* Yellow Theme */
    .bg-yellow-50 { background-color: #fefce8 !important; }
    .bg-yellow-200 { background-color: #fef08a !important; }
    .border-yellow-200 { border-color: #fef08a !important; }
    .text-yellow-600 { color: #ca8a04 !important; }
    .text-yellow-700 { color: #a16207 !important; }
    .text-yellow-900 { color: #713f12 !important; }

    /* Blue Theme */
    .bg-blue-50 { background-color: #eff6ff !important; }
    .border-blue-200 { border-color: #bfdbfe !important; }
    .text-blue-600 { color: #2563eb !important; }
    .text-blue-700 { color: #1d4ed8 !important; }
    .text-blue-900 { color: #1e3a8a !important; }

    /* Green Theme */
    .text-green-600 { color: #16a34a !important; }
    .bg-green-600 { background-color: #16a34a !important; color: white; }

    /* Cards & Badges */
    .card-ui { background: white; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .badge-ui { display: inline-flex; align-items: center; padding: 2px 10px; font-size: 12px; font-weight: 600; border-radius: 9999px; }
    .badge-destructive { background-color: #ef4444; color: white; }
    .badge-blue { background-color: #2563eb; color: white; }

    /* Tabs (Shadcn style) */
    .tabs-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); background-color: #f1f5f9; padding: 4px; border-radius: 8px; max-width: 28rem; margin-bottom: 20px; }
    .tabs-trigger { padding: 6px 16px; font-size: 14px; font-weight: 500; text-align: center; color: #64748b; border-radius: 6px; cursor: pointer; transition: all 0.2s; border: none; background: transparent; }
    .tabs-trigger.active { background-color: white; color: #0f172a; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    
    /* Buttons */
    .btn-ghost-ui { background: transparent; border: none; padding: 8px; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; }
    .btn-ghost-ui:hover { background-color: #f1f5f9; }
    .btn-ghost-ui:disabled { opacity: 0.5; cursor: not-allowed; }

    /* Search Input */
    .search-input-wrapper { position: relative; width: 100%; }
    .search-input-wrapper svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; width: 20px; height: 20px; }
    .search-input-wrapper input { width: 100%; padding: 10px 10px 10px 40px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 14px; outline: none; }
    .search-input-wrapper input:focus { border-color: #93c5fd; box-shadow: 0 0 0 2px rgba(59,130,246,0.1); }

    /* Table */
    .table-ui { width: 100%; border-collapse: collapse; }
    .table-ui th { text-align: left; padding: 12px 16px; font-size: 14px; font-weight: 500; color: #374151; border-bottom: 1px solid #e5e7eb; }
    .table-ui td { padding: 12px 16px; font-size: 14px; border-bottom: 1px solid #f3f4f6; }
    .table-ui tbody tr:hover { background-color: #f9fafb; }
</style>

@php
    // Mapping Data Backend ke Kebutuhan UI
    $highRiskPatients = $data->where('risk_level', 'high');
    $mediumRiskPatients = $data->where('risk_level', 'medium');
    
    $highPending = $highRiskPatients->where('status', 'pending')->count();
    $medPending = $mediumRiskPatients->where('status', 'pending')->count();
    
    // Status 'selesai' di backend kita anggap sebagai 'sudah_kontak' di React
    $totalNotifikasi = $data->where('status', 'selesai')->count();
@endphp

<div class="container-fluid p-0">
    
    <div class="mb-4">
        <h1 class="fw-bold text-gray-900 m-0" style="font-size: 30px;">Monitoring Risiko Tinggi</h1>
        <p class="text-gray-500 mt-1" style="font-size: 15px;">Pantau dan tindak lanjut pasien berisiko tinggi diabetes</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card-ui border-red-200 bg-red-50 p-4 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="text-red-600 m-0" style="font-size: 14px; font-weight: 500;">Risiko Tinggi</p>
                        <p class="text-red-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $highRiskPatients->count() }}</p>
                        <p class="text-red-700 m-0 mt-1" style="font-size: 14px;">{{ $highPending }} belum dihubungi</p>
                    </div>
                    <div class="bg-red-200 rounded p-2 d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-700"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-ui border-yellow-200 bg-yellow-50 p-4 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="text-yellow-600 m-0" style="font-size: 14px; font-weight: 500;">Risiko Sedang</p>
                        <p class="text-yellow-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $mediumRiskPatients->count() }}</p>
                        <p class="text-yellow-700 m-0 mt-1" style="font-size: 14px;">{{ $medPending }} belum dihubungi</p>
                    </div>
                    <div class="bg-yellow-200 rounded p-2 d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-700"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-ui border-blue-200 bg-blue-50 p-4 h-100">
                <div>
                    <p class="text-blue-600 m-0" style="font-size: 14px; font-weight: 500;">Total Notifikasi</p>
                    <p class="text-blue-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $totalNotifikasi }}</p>
                    <p class="text-blue-700 m-0 mt-1" style="font-size: 14px;">Terkirim bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card-ui p-4 mb-4">
        <div class="search-input-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="text" id="searchInput" placeholder="Cari pasien berdasarkan nama atau telepon...">
        </div>
    </div>

    <div class="tabs-list" role="tablist">
        <button class="tabs-trigger active" data-bs-toggle="pill" data-bs-target="#tab-tinggi" type="button" role="tab">
            Risiko Tinggi ({{ $highRiskPatients->count() }})
        </button>
        <button class="tabs-trigger" data-bs-toggle="pill" data-bs-target="#tab-sedang" type="button" role="tab">
            Risiko Sedang ({{ $mediumRiskPatients->count() }})
        </button>
    </div>

    <div class="tab-content">
        
        <div class="tab-pane fade show active" id="tab-tinggi" role="tabpanel">
            <div class="card-ui">
                <div class="p-4 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900 d-flex align-items-center gap-2" style="font-size: 18px; font-weight: 600;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                        Pasien Risiko Tinggi - Perlu Tindak Lanjut Segera
                    </h3>
                </div>
                <div class="p-0 overflow-auto">
                    <table class="table-ui">
                        <thead>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>Usia</th>
                                <th>Gula Darah</th>
                                <th>BMI</th>
                                <th>Tekanan Darah</th>
                                <th>Tindak Lanjut</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($highRiskPatients as $patient)
                            <tr class="{{ $patient->status == 'pending' ? 'bg-red-50' : '' }} patient-row">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($patient->status == 'pending')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                                        @endif
                                        <span class="text-gray-900" style="font-weight: 500;">{{ $patient->patient->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="text-gray-600">{{ $patient->age }} tahun</td>
                                <td>
                                    <span style="font-weight: 500;" class="{{ $patient->blood_sugar >= 126 ? 'text-red-600' : ($patient->blood_sugar >= 100 ? 'text-yellow-600' : 'text-green-600') }}">
                                        {{ $patient->blood_sugar }} mg/dL
                                    </span>
                                </td>
                                <td class="text-gray-600">{{ number_format($patient->bmi, 1) }}</td>
                                <td class="text-gray-600">{{ $patient->blood_pressure ?? '-' }}</td>
                                <td class="text-gray-700">Rujuk ke Puskesmas</td>
                                <td>
                                    @if($patient->status == 'pending')
                                        <span class="badge-ui badge-destructive">Belum Kontak</span>
                                    @elseif($patient->status == 'dipantau')
                                        <span class="badge-ui badge-blue">Proses Rujukan</span>
                                    @else
                                        <span class="badge-ui bg-green-600">Sudah Kontak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ $patient->patient->phone ? 'tel:'.$patient->patient->phone : '#' }}" class="btn-ghost-ui">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                        </a>
                                        
                                        @if($patient->status == 'pending')
                                            <a href="/monitoring/{{ $patient->id }}/selesai" class="btn-ghost-ui">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                            </a>
                                        @else
                                            <button class="btn-ghost-ui" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-gray-500">Tidak ada data pasien yang ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-sedang" role="tabpanel">
            <div class="card-ui">
                <div class="p-4 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900" style="font-size: 18px; font-weight: 600;">
                        Pasien Risiko Sedang - Perlu Edukasi & Monitoring
                    </h3>
                </div>
                <div class="p-0 overflow-auto">
                    <table class="table-ui">
                        <thead>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>Usia</th>
                                <th>Gula Darah</th>
                                <th>BMI</th>
                                <th>Tekanan Darah</th>
                                <th>Tindak Lanjut</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mediumRiskPatients as $patient)
                            <tr class="patient-row">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-gray-900" style="font-weight: 500;">{{ $patient->patient->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="text-gray-600">{{ $patient->age }} tahun</td>
                                <td>
                                    <span style="font-weight: 500;" class="{{ $patient->blood_sugar >= 126 ? 'text-red-600' : ($patient->blood_sugar >= 100 ? 'text-yellow-600' : 'text-green-600') }}">
                                        {{ $patient->blood_sugar }} mg/dL
                                    </span>
                                </td>
                                <td class="text-gray-600">{{ number_format($patient->bmi, 1) }}</td>
                                <td class="text-gray-600">{{ $patient->blood_pressure ?? '-' }}</td>
                                <td class="text-gray-700">Edukasi pola hidup</td>
                                <td>
                                    @if($patient->status == 'pending')
                                        <span class="badge-ui badge-destructive">Belum Kontak</span>
                                    @elseif($patient->status == 'dipantau')
                                        <span class="badge-ui badge-blue">Proses Pantau</span>
                                    @else
                                        <span class="badge-ui bg-green-600">Sudah Kontak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ $patient->patient->phone ? 'tel:'.$patient->patient->phone : '#' }}" class="btn-ghost-ui">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                        </a>
                                        
                                        @if($patient->status == 'pending')
                                            <a href="/monitoring/{{ $patient->id }}/selesai" class="btn-ghost-ui">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                            </a>
                                        @else
                                            <button class="btn-ghost-ui" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-gray-500">Tidak ada data pasien yang ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('.patient-row');
        
        rows.forEach(row => {
            let name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            if (name.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection
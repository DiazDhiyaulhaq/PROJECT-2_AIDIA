@extends('layout')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
    <p class="text-secondary mt-0">Sistem Monitoring Diabetes Posbindu</p>
</div>

<style>
    .bg-blue-100 { background-color: #dbeafe !important; }
    .text-blue-600 { color: #2563eb !important; }
    .bg-red-100 { background-color: #fee2e2 !important; }
    .text-red-600 { color: #dc2626 !important; }
    .bg-green-100 { background-color: #d1fae5 !important; }
    .text-green-600 { color: #16a34a !important; }
    .bg-purple-100 { background-color: #f3e8ff !important; }
    .text-purple-600 { color: #9333ea !important; }
    
    .badge-soft-danger { background-color: #fee2e2; color: #b91c1c; }
    .badge-soft-warning { background-color: #fef3c7; color: #b45309; }
    .badge-soft-success { background-color: #d1fae5; color: #047857; }
    
    .card { border-radius: 12px; }
    .table th { font-weight: 600; color: #4b5563; font-size: 0.875rem; }
    .table td { font-size: 0.875rem; color: #1f2937; vertical-align: middle; }
</style>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100 p-2">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 14px;">Total Pasien</p>
                    <h3 class="fw-bold text-dark mb-1">{{ $totalPatients ?? 0 }}</h3>
                    <small class="text-success fw-medium">+12% dari bulan lalu</small>
                </div>
                <div class="p-2 rounded bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100 p-2">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 14px;">Risiko Tinggi</p>
                    <h3 class="fw-bold text-dark mb-1">{{ $high ?? 0 }}</h3>
                    <small class="text-success fw-medium">+5% dari bulan lalu</small>
                </div>
                <div class="p-2 rounded bg-red-100 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100 p-2">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 14px;">Skrining Bulan Ini</p>
                    <h3 class="fw-bold text-dark mb-1">{{ $screeningThisMonth ?? 0 }}</h3>
                    <small class="text-success fw-medium">+23% dari bulan lalu</small>
                </div>
                <div class="p-2 rounded bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><path d="m9 11 3 3L22 4"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100 p-2">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 14px;">Total Skrining</p>
                    <h3 class="fw-bold text-dark mb-1">{{ $totalScreenings ?? 0 }}</h3>
                    <small class="text-success fw-medium">+3% dari bulan lalu</small>
                </div>
                <div class="p-2 rounded bg-purple-100 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 p-4 h-100">
            <h6 class="fw-bold text-dark mb-4">Skrining per Bulan</h6>
            <div style="height: 300px;">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm border-0 p-4 h-100">
            <h6 class="fw-bold text-dark mb-4">Tren Kategori Risiko</h6>
            <div style="height: 300px;">
                <canvas id="riskChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 p-4 mb-4">
    <h6 class="fw-bold text-dark mb-3">Skrining Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="border-bottom">
                <tr>
                    <th class="border-0 pb-3">Nama Pasien</th>
                    <th class="border-0 pb-3">Usia</th>
                    <th class="border-0 pb-3">Kategori Risiko</th>
                    <th class="border-0 pb-3">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent ?? [] as $r)
                <tr>
                    <td class="py-3">{{ $r->patient->name ?? 'N/A' }}</td>
                    <td class="py-3 text-secondary">{{ $r->age }} tahun</td>
                    <td class="py-3">
                        <span class="badge px-3 py-2 rounded-pill 
                            {{ strtolower($r->risk_level) == 'high' ? 'badge-soft-danger' : 
                               (strtolower($r->risk_level) == 'medium' ? 'badge-soft-warning' : 'badge-soft-success') }}">
                            {{ ucfirst($r->risk_level) }}
                        </span>
                    </td>
                    <td class="py-3 text-secondary">{{ \Carbon\Carbon::parse($r->created_at)->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data skrining</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data Bar Chart (Skrining Per Bulan)
const labels = {!! json_encode($labels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']) !!};
const monthlyData = {!! json_encode($monthly ?? [45, 52, 48, 61, 55, 67]) !!};

new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Skrining',
            data: monthlyData,
            backgroundColor: '#3b82f6', // Warna biru sama dengan react
            borderRadius: 6,
            barThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { borderDash: [3, 3] } },
            x: { grid: { display: false } }
        }
    }
});

// Data Line Chart (Tren Kategori Risiko)
// Catatan: Jika Controller belum mem-passing data ini secara spesifik per bulan,
// saya buatkan fallback mock data persis seperti desain React agar langsung bisa tampil.
const trendLow = {!! json_encode($trendLow ?? [30, 35, 32, 38, 40, 45]) !!};
const trendMedium = {!! json_encode($trendMedium ?? [12, 15, 18, 20, 22, 25]) !!};
const trendHigh = {!! json_encode($trendHigh ?? [8, 10, 12, 15, 18, 20]) !!};

new Chart(document.getElementById('riskChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Risiko Rendah',
                data: trendLow,
                borderColor: '#10b981',
                backgroundColor: '#10b981',
                tension: 0.3,
                borderWidth: 2
            },
            {
                label: 'Risiko Sedang',
                data: trendMedium,
                borderColor: '#f59e0b',
                backgroundColor: '#f59e0b',
                tension: 0.3,
                borderWidth: 2
            },
            {
                label: 'Risiko Tinggi',
                data: trendHigh,
                borderColor: '#ef4444',
                backgroundColor: '#ef4444',
                tension: 0.3,
                borderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { 
                display: true, 
                position: 'bottom',
                labels: { usePointStyle: true, boxWidth: 6 }
            }
        },
        scales: {
            y: { beginAtZero: true, grid: { borderDash: [3, 3] } },
            x: { grid: { display: false } }
        }
    }
});
</script>

@endsection
@extends('layout')

@section('content')

<style>
    .text-gray-500 { color: #6b7280; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-900 { color: #111827; }
    
    .bg-blue-100 { background-color: #dbeafe !important; }
    .text-blue-600 { color: #2563eb !important; }
    
    .bg-green-100 { background-color: #d1fae5 !important; }
    .text-green-600 { color: #16a34a !important; }
    
    .bg-yellow-100 { background-color: #fef08a !important; }
    .text-yellow-600 { color: #ca8a04 !important; }
    
    .bg-red-100 { background-color: #fee2e2 !important; }
    .text-red-600 { color: #dc2626 !important; }

    .bg-purple-100 { background-color: #f3e8ff !important; }
    .text-purple-600 { color: #9333ea !important; }

    .card-ui { background: white; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .chart-container { width: 100%; height: 300px; display: flex; justify-content: center; align-items: center; }
    
    .btn-outline-ui { border: 1px solid #e5e7eb; background: transparent; color: #374151; padding: 8px 16px; border-radius: 6px; display: flex; align-items: center; justify-content: flex-start; gap: 8px; width: 100%; transition: all 0.2s; text-decoration: none; font-size: 14px; font-weight: 500;}
    .btn-outline-ui:hover { background-color: #f3f4f6; color: #111827; }
    
    .form-select-ui { border: 1px solid #e5e7eb; padding: 8px 12px; border-radius: 6px; font-size: 14px; color: #374151; width: 200px; outline: none;}
</style>

<div class="container-fluid p-0">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gray-900 m-0" style="font-size: 30px;">Laporan & Evaluasi</h1>
            <p class="text-gray-500 mt-1" style="font-size: 15px;">Laporan otomatis program skrining diabetes</p>
        </div>
        <div class="d-flex gap-2">
            <select class="form-select-ui">
                <option value="semester-1-2026">Semester 1 2026</option>
                <option value="semester-2-2025">Semester 2 2025</option>
                <option value="tahun-2025">Tahun 2025</option>
            </select>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Total Skrining</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $total }}</p>
                        <p class="text-green-600 m-0 mt-1" style="font-size: 13px;">Data terkumpul</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Risiko Rendah</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $low }}</p>
                        <p class="text-green-600 m-0 mt-1" style="font-size: 13px;">{{ $total > 0 ? round(($low/$total)*100) : 0 }}% dari total</p>
                    </div>
                    <div class="bg-green-100 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Kasus Terdeteksi</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $high }}</p>
                        <p class="text-red-600 m-0 mt-1" style="font-size: 13px;">{{ $total > 0 ? round(($high/$total)*100) : 0 }}% risiko tinggi</p>
                    </div>
                    <div class="bg-red-100 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-ui p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-gray-600 m-0" style="font-size: 14px;">Risiko Sedang</p>
                        <p class="text-gray-900 m-0 mt-2 fw-bold" style="font-size: 30px;">{{ $medium }}</p>
                        <p class="text-yellow-600 m-0 mt-1" style="font-size: 13px;">Perlu edukasi</p>
                    </div>
                    <div class="bg-yellow-100 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-600"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card-ui d-flex flex-column h-100">
                <div class="p-3 pb-0 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Tren Skrining per Bulan</h3>
                </div>
                <div class="p-3 flex-grow-1 chart-container">
                    <canvas id="monthlyLineChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card-ui d-flex flex-column h-100">
                <div class="p-3 pb-0 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Distribusi Kategori Risiko</h3>
                </div>
                <div class="p-3 flex-grow-1 chart-container">
                    <canvas id="riskPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card-ui d-flex flex-column h-100">
                <div class="p-3 pb-0 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Distribusi Usia Peserta</h3>
                </div>
                <div class="p-3 flex-grow-1 chart-container">
                    <canvas id="ageBarChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card-ui d-flex flex-column h-100">
                <div class="p-3 pb-0 border-bottom border-gray-200">
                    <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Komposisi Jenis Kelamin</h3>
                </div>
                <div class="p-3 flex-grow-1 chart-container">
                    <canvas id="genderPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card-ui mb-4">
        <div class="p-3 pb-0 border-bottom border-gray-200">
            <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Tren Kategori Risiko per Bulan</h3>
        </div>
        <div class="p-3 chart-container" style="height: 350px;">
            <canvas id="stackedRiskChart"></canvas>
        </div>
    </div>

    <div class="card-ui mb-4">
        <div class="p-3 pb-0 border-bottom border-gray-200">
            <h3 class="m-0 text-gray-900 fw-bold mb-3" style="font-size: 18px;">Ekspor Laporan</h3>
        </div>
        <div class="p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <button class="btn-outline-ui" onclick="alert('Fitur Ekspor Excel segera hadir!')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download Excel
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn-outline-ui" onclick="alert('Fitur Ekspor PDF segera hadir!')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download PDF
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn-outline-ui" onclick="alert('Fitur Ekspor CSV segera hadir!')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download CSV
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Data dari Laravel
    const monthNames = {1:'Jan', 2:'Feb', 3:'Mar', 4:'Apr', 5:'Mei', 6:'Jun', 7:'Jul', 8:'Agu', 9:'Sep', 10:'Okt', 11:'Nov', 12:'Des'};
    const rawLabels = {!! json_encode(array_keys($monthly->toArray())) !!};
    const labelsBulan = rawLabels.map(num => monthNames[num] || num);
    const dataSkrining = {!! json_encode(array_values($monthly->toArray())) !!};
    const dataRisk = [{{ $low }}, {{ $medium }}, {{ $high }}];

    // 2. Line Chart (Tren Bulanan) -> Diubah dari Bar menjadi Line sesuai React
    new Chart(document.getElementById('monthlyLineChart'), {
        type: 'line',
        data: {
            labels: labelsBulan,
            datasets: [{
                label: 'Total Skrining',
                data: dataSkrining,
                borderColor: '#3b82f6',
                backgroundColor: 'transparent',
                borderWidth: 2,
                tension: 0.3,
                pointBackgroundColor: '#3b82f6'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, grid: { borderDash: [3, 3] } }, x: { grid: { display: false } } } }
    });

    // 3. Pie Chart (Distribusi Risiko)
    new Chart(document.getElementById('riskPieChart'), {
        type: 'pie',
        data: {
            labels: ['Risiko Rendah', 'Risiko Sedang', 'Risiko Tinggi'],
            datasets: [{
                data: dataRisk,
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
    });

    // 4. Bar Chart (Usia) - Placeholder Data Statis
    new Chart(document.getElementById('ageBarChart'), {
        type: 'bar',
        data: {
            labels: ['<40', '40-49', '50-59', '60-69', '≥70'],
            datasets: [{ label: 'Jumlah Peserta', data: [45, 98, 125, 48, 12], backgroundColor: '#8b5cf6', borderRadius: 4 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { borderDash: [3, 3] } }, x: { grid: { display: false } } } }
    });

    // 5. Pie Chart (Gender) - Placeholder Data Statis
    new Chart(document.getElementById('genderPieChart'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{ data: [142, 186], backgroundColor: ['#3b82f6', '#ec4899'], borderWidth: 0 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
    });

    // 6. Stacked Bar (Tren Kategori Risiko) - Placeholder Data Statis
    new Chart(document.getElementById('stackedRiskChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                { label: 'Risiko Rendah', data: [25, 27, 22, 28, 21, 25], backgroundColor: '#10b981' },
                { label: 'Risiko Sedang', data: [12, 15, 14, 18, 16, 22], backgroundColor: '#f59e0b' },
                { label: 'Risiko Tinggi', data: [8, 10, 12, 15, 18, 20], backgroundColor: '#ef4444' }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { x: { stacked: true, grid: { display: false } }, y: { stacked: true, beginAtZero: true, grid: { borderDash: [3, 3] } } } }
    });
</script>

@endsection
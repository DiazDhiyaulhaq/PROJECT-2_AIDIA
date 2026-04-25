<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Skrining Diabetes - {{ $screening->patient->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
            line-height: 1.5;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        /* HEADER */
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #111827;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        /* SECTION TITLES */
        .section-title {
            font-size: 16px;
            color: #2563eb;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 15px;
            margin-top: 30px;
        }

        /* TABLES */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-data th, .table-data td {
            padding: 10px;
            border: 1px solid #e5e7eb;
        }
        .table-data th {
            background-color: #f9fafb;
            text-align: left;
            width: 40%;
            color: #4b5563;
        }
        .table-data td {
            color: #111827;
            font-weight: bold;
        }

        /* STATUS BOX */
        .result-box {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid;
        }
        .result-box h2 { margin: 0 0 5px 0; font-size: 22px; }
        .result-box p { margin: 0; font-size: 14px; }

        /* COLORS */
        .box-low { background-color: #f0fdf4; border-color: #bbf7d0; color: #166534; }
        .box-medium { background-color: #fffbeb; border-color: #fde68a; color: #92400e; }
        .box-high { background-color: #fef2f2; border-color: #fecaca; color: #991b1b; }

        /* FOOTER */
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 14px;
        }
        .signature-line {
            margin-top: 60px;
            border-bottom: 1px solid #333;
            width: 200px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>AIDIA - POSBINDU</h1>
        <p>Laporan Hasil Skrining Risiko Diabetes Mellitus</p>
    </div>

    <div class="section-title">A. Data Pasien</div>
    <table class="table-data">
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $screening->patient->name }}</td>
        </tr>
        <tr>
            <th>Usia</th>
            <td>{{ $screening->age }} Tahun</td>
        </tr>
        <tr>
            <th>Tanggal Skrining</th>
            <td>{{ \Carbon\Carbon::parse($screening->created_at)->format('d F Y') }}</td>
        </tr>
    </table>

    <div class="section-title">B. Hasil Pemeriksaan Klinis</div>
    <table class="table-data">
        <tr>
            <th>Body Mass Index (BMI)</th>
            <td>{{ number_format($screening->bmi, 2) }}</td>
        </tr>
        <tr>
            <th>Kadar Gula Darah</th>
            <td>{{ $screening->blood_sugar }} <span style="font-weight: normal; color: #6b7280;">mg/dL</span></td>
        </tr>
        @if(isset($screening->blood_pressure))
        <tr>
            <th>Tekanan Darah</th>
            <td>{{ $screening->blood_pressure }}</td>
        </tr>
        @endif
    </table>

    <div class="section-title">C. Kesimpulan & Rekomendasi</div>
    
    @if($screening->risk_level == 'low')
        <div class="result-box box-low">
            <h2>KATEGORI RISIKO: RENDAH</h2>
            <p>Kondisi pasien saat ini terpantau aman.</p>
        </div>
        <ul style="color: #4b5563;">
            <li>Pertahankan gaya hidup sehat dan asupan gizi seimbang.</li>
            <li>Lakukan aktivitas fisik secara teratur.</li>
        </ul>

    @elseif($screening->risk_level == 'medium')
        <div class="result-box box-medium">
            <h2>KATEGORI RISIKO: SEDANG</h2>
            <p>Pasien memiliki potensi risiko. Perlu perbaikan pola hidup.</p>
        </div>
        <ul style="color: #4b5563;">
            <li>Perbaiki pola makan (kurangi karbohidrat berlebih dan makanan manis).</li>
            <li>Mulai lakukan olahraga ringan minimal 30 menit setiap hari.</li>
        </ul>

    @else
        <div class="result-box box-high">
            <h2>KATEGORI RISIKO: TINGGI</h2>
            <p>Pasien berisiko tinggi terkena Diabetes Mellitus.</p>
        </div>
        <ul style="color: #4b5563;">
            <li><b>Segera lakukan konsultasi ke dokter atau fasilitas kesehatan terdekat.</b></li>
            <li>Kurangi konsumsi gula harian secara ketat.</li>
            <li>Rutin memantau kadar gula darah secara berkala.</li>
        </ul>
    @endif

    <div class="footer">
        <p>Subang, {{ date('d F Y') }}</p>
        <p>Petugas / Kader Pemeriksa,</p>
        <div class="signature-line"></div>
        <p style="margin-top: 5px;">{{ auth()->user()->name ?? 'Admin Posbindu' }}</p>
    </div>

</body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Screening;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ========================
        // KPI UTAMA
        // ========================
        $totalPatients = Patient::count();
        $totalScreenings = Screening::count();

        $high = Screening::where('risk_level', 'high')->count();
        $medium = Screening::where('risk_level', 'medium')->count();
        $low = Screening::where('risk_level', 'low')->count();

        // ========================
        // SCREENING BULAN INI
        // ========================
        $screeningThisMonth = Screening::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // ========================
        // DATA BULANAN (12 BULAN)
        // ========================
        $monthlyRaw = Screening::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $monthly = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthly[] = $monthlyRaw[$i] ?? 0;
        }

        $labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        // ========================
        // RECENT SCREENING
        // ========================
        $recent = Screening::with('patient')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPatients',
            'totalScreenings',
            'high',
            'medium',
            'low',
            'screeningThisMonth',
            'monthly',
            'labels',
            'recent'
        ));
    }

    // ========================
    // HALAMAN LAPORAN
    // ========================
public function laporan()
    {
        // 1. Menghitung data summary
        $total = Screening::count();
        $low = Screening::where('risk_level', 'low')->count();
        $medium = Screening::where('risk_level', 'medium')->count();
        $high = Screening::where('risk_level', 'high')->count();

        // 2. Mengambil data untuk grafik (Chart.js)
        // Format Collection pluck() agar kompatibel dengan toArray() di blade
        $monthly = Screening::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // 3. Mengambil list screening (jika nanti ditambahkan tabel di bawah grafik)
        $screenings = Screening::with('patient')->latest()->get();
        
        // Memanggil view dan menyisipkan SEMUA variabel yang dibutuhkan
        return view('laporan.index', compact(
            'total', 
            'low', 
            'medium', 
            'high', 
            'monthly', 
            'screenings'
        ));
    }

}
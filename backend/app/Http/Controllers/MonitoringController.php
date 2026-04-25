<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening; // Pastikan model yang digunakan sesuai (biasanya Screening)

class MonitoringController extends Controller
{
    public function index()
    {
        // Mengambil data skrining terbaru beserta relasi pasiennya
        $data = Screening::with('patient')->latest()->get();
        return view('monitoring.index', compact('data'));
    }

    // 🔥 INI FUNGSI UNTUK MENGUBAH STATUSNYA
    public function updateStatus($id, $status)
    {
        // 1. Cari data skrining berdasarkan ID
        $screening = Screening::findOrFail($id);

        // 2. Validasi agar status yang masuk hanya yang diizinkan
        $validStatuses = ['pending', 'dipantau', 'selesai'];
        
        if (in_array($status, $validStatuses)) {
            // 3. Update statusnya di database
            $screening->status = $status;
            $screening->save();

            // 4. Kembalikan ke halaman monitoring dengan pesan sukses
            return back()->with('success', 'Status pasien berhasil diperbarui menjadi: ' . ucfirst($status));
        }

        // Jika status tidak valid
        return back()->with('error', 'Status tidak valid!');
    }
}
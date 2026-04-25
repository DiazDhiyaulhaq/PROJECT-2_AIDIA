<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        // 🔥 Pastikan user login & admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // 🔥 AMBIL DATA SEMUA KADER UNTUK TABEL
        $users = User::where('role', 'kader')->latest()->get();

        return view('users.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // 🔥 Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kader'
        ]);

        // 🔥 Balik ke halaman yang sama supaya tabel terupdate
        return redirect('/users/create')->with('success', 'Kader berhasil dibuat');
    }

    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Cari dan hapus
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kader berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai query
        $query = Patient::query();

        // 2. Cek apakah ada inputan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Filter berdasarkan Nama atau NIK
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%');
        }

        // 3. Eksekusi query (latest() agar pasien terbaru muncul di atas)
        $patients = $query->latest()->get();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:patients',
            'name' => 'required',
            'gender' => 'required',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable',
            'diabetes_history' => 'required'
        ]);

        Patient::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone' => $request->phone,
            'diabetes_history' => $request->diabetes_history,
            'created_by' => Auth::id()
        ]);

        return redirect('/patients')->with('success','Pasien berhasil ditambahkan');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:patients,nik,' . $id,
            'name' => 'required',
            'gender' => 'required',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable',
            'diabetes_history' => 'required'
        ]);

        $patient->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone' => $request->phone,
            'diabetes_history' => $request->diabetes_history,
        ]);

        return redirect('/patients')->with('success','Pasien berhasil diupdate');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect('/patients')->with('success','Pasien berhasil dihapus');
    }
}
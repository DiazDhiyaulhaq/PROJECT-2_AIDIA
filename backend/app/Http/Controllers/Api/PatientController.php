<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $data = Patient::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:patients',
            'name' => 'required',
            'gender' => 'required'
        ]);

        $patient = Patient::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'created_by' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil ditambahkan',
            'data' => $patient
        ]);
    }
}
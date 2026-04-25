<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScreeningController extends Controller
{
    // 🔥 LIST SCREENING
    public function index()
    {
        return response()->json(
            Screening::with('patient')->latest()->get()
        );
    }

    // 🔥 CREATE SCREENING
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'age' => 'required',
        ]);

        // 🔥 HITUNG BMI
        $heightMeter = $request->height / 100;
        $bmi = $request->weight / ($heightMeter * $heightMeter);

        // 🔥 LOGIKA RISIKO
        $riskScore = 0;

        if ($bmi >= 25) $riskScore++;
        if ($request->age > 40) $riskScore++;
        if ($request->blood_sugar > 140) $riskScore++;
        if ($request->family_history) $riskScore++;
        if (!$request->physical_activity) $riskScore++;

        // 🔥 KLASIFIKASI
        if ($riskScore <= 1) {
            $risk = 'low';
        } elseif ($riskScore <= 3) {
            $risk = 'medium';
        } else {
            $risk = 'high';
        }

        // 🔥 AUTO STATUS
        if ($risk == 'low') {
            $status = 'pending';
        } elseif ($risk == 'medium') {
            $status = 'dipantau';
        } else {
            $status = 'pending';
        }

        $data = Screening::create([
            'patient_id' => $request->patient_id,
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi' => $bmi,
            'age' => $request->age,
            'blood_sugar' => $request->blood_sugar,
            'blood_pressure' => $request->blood_pressure,
            'waist_circumference' => $request->waist_circumference,
            'physical_activity' => $request->physical_activity,
            'family_history' => $request->family_history,
            'risk_level' => $risk,
            'status' => $status,
            'created_by' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'risk' => $risk,
            'data' => $data
        ]);
    }

    // 🔥 MONITORING (SEMUA DATA)
    public function monitoring()
    {
        return response()->json(
            Screening::with('patient')->latest()->get()
        );
    }

    // 🔥 UPDATE STATUS (PENTING BANGET BUAT MOBILE)
    public function updateStatus(Request $request, $id)
    {
        $item = Screening::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);

        $item->status = $request->status;
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated',
            'data' => $item
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Screening;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ScreeningController extends Controller
{
    public function index()
    {
        $data = Screening::with('patient')->latest()->get();
        return view('screenings.index', compact('data'));
    }

    public function selectPatient()
    {
        $patients = Patient::all();
        return view('screenings.select', compact('patients'));
    }

    public function form($id)
    {
        $patient = Patient::findOrFail($id);
        return view('screenings.form', compact('patient'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'blood_sugar' => 'required',
        ]);

        // 🔥 Ambil umur otomatis dari patient
        $patient = Patient::find($request->patient_id);
        $age = $patient->age ?? 0;

        // 🔥 Hitung BMI
        $heightMeter = $request->height / 100;
        $bmi = $request->weight / ($heightMeter * $heightMeter);

        // 🔥 Hitung skor
        $score = 0;

        if ($bmi >= 25) $score++;
        if ($age > 40) $score++;
        if ($request->blood_sugar > 140) $score++;
        if ($request->family_history) $score++;
        if (!$request->physical_activity) $score++;

        // 🔥 Tentukan risiko
        if ($score <= 1) {
            $risk = 'low';
        } elseif ($score <= 3) {
            $risk = 'medium';
        } else {
            $risk = 'high';
        }

        $screening = Screening::create([
            'patient_id' => $request->patient_id,
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi' => $bmi,
            'age' => $age,
            'blood_sugar' => $request->blood_sugar,
            'blood_pressure' => $request->blood_pressure,
            'waist_circumference' => $request->waist_circumference,
            'physical_activity' => $request->physical_activity,
            'family_history' => $request->family_history,
            'risk_level' => $risk,
            'status' => 'pending'
        ]);

        return redirect('/screenings/result/' . $screening->id);
    }

    public function result($id)
    {
        $data = Screening::with('patient')->findOrFail($id);
        return view('screenings.result', compact('data'));
    }

    public function pdf($id)
    {
        $screening = Screening::with('patient')->findOrFail($id);
        $pdf = Pdf::loadView('screenings.pdf', compact('screening'));
        return $pdf->download('hasil.pdf');
    }
}
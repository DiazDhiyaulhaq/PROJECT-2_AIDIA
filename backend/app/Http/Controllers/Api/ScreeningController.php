<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Screening;
use App\Models\Patient;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ScreeningController extends Controller
{
    // 🔥 LIST SCREENING
    public function index()
    {
        return response()->json(

            Screening::with('patient')
                ->latest()
                ->get()
        );
    }

    // 🔥 QUICK GLUCOSE LOG MOBILE
    public function storeGlucose(Request $request)
    {
        $request->validate([

            'glucose' =>
                'required|numeric'
        ]);

        // 🔥 AMBIL USER LOGIN
        $user = Auth::user();

        // 🔥 CARI PATIENT MILIK USER
        $patient = Patient::where(
            'created_by',
            $user->id
        )->first();

        // 🔥 JIKA TIDAK ADA
        if (!$patient) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Patient tidak ditemukan'

            ], 404);
        }

        // 🔥 SAVE SCREENING
        $data = Screening::create([

            'patient_id' =>
                $patient->id,

            // dummy sementara
            'weight' => 0,

            'height' => 0,

            'age' => 0,

            // glucose asli
            'blood_sugar' =>
                $request->glucose,

            // default value
            'blood_pressure' => '-',

            'waist_circumference' => 0,

            'physical_activity' => 1,

            'family_history' => 0,

            'bmi' => 0,

            'risk_level' => 'low',

            'status' => 'pending',

            'created_by' =>
                $user->id
        ]);

        return response()->json([

            'success' => true,

            'message' =>
                'Glucose berhasil disimpan',

            'data' =>
                $data
        ]);
    }

    // 🔥 CREATE SCREENING FULL
    public function store(Request $request)
    {
        $request->validate([

            'patient_id' => 'required',

            'weight' => 'required',

            'height' => 'required',

            'age' => 'required',
        ]);

        $heightMeter =
            $request->height / 100;

        $bmi =
            $request->weight /
            ($heightMeter * $heightMeter);

        $riskScore = 0;

        if ($bmi >= 25)
            $riskScore++;

        if ($request->age > 40)
            $riskScore++;

        if ($request->blood_sugar > 140)
            $riskScore++;

        if ($request->family_history)
            $riskScore++;

        if (!$request->physical_activity)
            $riskScore++;

        if ($riskScore <= 1) {

            $risk = 'low';

        } elseif ($riskScore <= 3) {

            $risk = 'medium';

        } else {

            $risk = 'high';
        }

        if ($risk == 'low') {

            $status = 'pending';

        } elseif ($risk == 'medium') {

            $status = 'dipantau';

        } else {

            $status = 'pending';
        }

        $data = Screening::create([

            'patient_id' =>
                $request->patient_id,

            'weight' =>
                $request->weight,

            'height' =>
                $request->height,

            'bmi' =>
                $bmi,

            'age' =>
                $request->age,

            'blood_sugar' =>
                $request->blood_sugar,

            'blood_pressure' =>
                $request->blood_pressure,

            'waist_circumference' =>
                $request->waist_circumference,

            'physical_activity' =>
                $request->physical_activity,

            'family_history' =>
                $request->family_history,

            'risk_level' =>
                $risk,

            'status' =>
                $status,

            'created_by' =>
                Auth::id()
        ]);

        return response()->json([

            'success' => true,

            'risk' => $risk,

            'data' => $data
        ]);
    }

    // 🔥 MONITORING
    public function monitoring()
    {
        return response()->json(

            Screening::with('patient')
                ->latest()
                ->get()
        );
    }

    // 🔥 UPDATE STATUS
    public function updateStatus(
        Request $request,
        $id
    ) {

        $item =
            Screening::findOrFail($id);

        $request->validate([

            'status' => 'required'
        ]);

        $item->status =
            $request->status;

        $item->save();

        return response()->json([

            'success' => true,

            'message' =>
                'Status updated',

            'data' =>
                $item
        ]);
    }
}
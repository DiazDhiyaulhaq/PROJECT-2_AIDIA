<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Patient;

class ReminderController extends Controller
{
    public function index()
    {
        $data = Reminder::with('patient')->latest()->get();
        $patients = Patient::all(); 

        return view('reminders.index', compact('data', 'patients'));
    }

public function store(Request $request)
    {
        Reminder::create([
            'user_id'       => $request->user_id,
            'medicine_name' => $request->medicine_name,
            'medicine_type' => $request->medicine_type,
            'dosage'        => $request->dosage,
            'frequency'     => $request->frequency,
            'time'          => $request->time,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date
        ]);

        return redirect('/reminders')->with('success', 'Pengingat obat berhasil ditambahkan!');
    }
}
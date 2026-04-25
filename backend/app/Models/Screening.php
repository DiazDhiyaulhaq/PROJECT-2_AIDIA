<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = [
    'patient_id',
    'weight',
    'height',
    'bmi',
    'age',
    'blood_sugar',
    'blood_pressure',
    'waist_circumference',
    'physical_activity',
    'family_history',
    'risk_level',
    'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
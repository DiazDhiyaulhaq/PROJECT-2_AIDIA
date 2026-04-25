<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'address',
        'phone',
        'diabetes_history',
        'created_by'
    ];

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    public function getAgeAttribute()
    {
        if (!$this->birth_date) return null;

        return Carbon::parse($this->birth_date)->age;
    }


}



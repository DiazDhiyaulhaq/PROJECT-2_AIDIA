<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    // Tambahkan semua nama kolom di sini agar diizinkan masuk ke database
    protected $fillable = [
        'user_id', 
        'medicine_name', 
        'medicine_type', 
        'dosage', 
        'frequency', 
        'time', 
        'start_date', 
        'end_date'
    ];

    // Relasi ke tabel pasien (Asumsi model kamu bernama Patient)
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }
}
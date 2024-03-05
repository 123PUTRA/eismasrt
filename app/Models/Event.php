<?php

namespace App\Models;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal',
        'lokasi',
    ];

    protected $table = 'events';

    // Relasi dengan pendaftaran
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
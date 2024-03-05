<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autendenci extends Model
{
    use HasFactory;
    protected $fillable = ['registration_id', 'attended'];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
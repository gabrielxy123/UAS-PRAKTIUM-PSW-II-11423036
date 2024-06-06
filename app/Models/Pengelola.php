<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengelola extends Authenticatable
{
    use HasFactory;
    protected $guard = 'pengelolas';

    public function lokasi() {
        return $this->belongsTo(Lokasi::class, 'lokasi_id'); // updated to lokasi_id
    }

    public function lapangans()
    {
        return $this->hasMany(Lapangan::class, 'pengelola_id');
    }
}


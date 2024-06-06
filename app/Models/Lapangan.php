<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $table = 'lapangans';
    
    public function pengelola() {
        return $this->belongsTo(Pengelola::class, 'pengelola_id'); 
    }
    public function lokasi() {
        return $this->belongsTo(Lokasi::class, 'lokasii_id'); 
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}

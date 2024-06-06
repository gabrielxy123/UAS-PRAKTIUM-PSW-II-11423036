<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    public function lapangan() {
        return $this->belongsTo(Lapangan::class, 'lapangan_id'); 
    }
    public function lokasi() {
        return $this->belongsTo(Lokasi::class, 'lokasi_id'); 
    }
    
}

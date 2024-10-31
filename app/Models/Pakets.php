<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakets extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga_total',
        'destination_id',
        'hotel_id',
        'transport_id',
        'rating',
        'ulasan',
        'total_pembelian',
    ];
    // Relationship with Destination
    public function destination()
    {
        return $this->belongsTo(Destinations::class);
    }

    // Relationship with Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotels::class);
    }

    // Relationship with Transport
    public function transport()
    {
        return $this->belongsTo(Transports::class);
    }
}

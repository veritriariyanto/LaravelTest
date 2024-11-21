<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
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
        return $this->belongsTo(Destination::class);
    }

    // Relationship with Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Relationship with Transport
    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}

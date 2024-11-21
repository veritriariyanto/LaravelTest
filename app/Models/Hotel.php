<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model // Ubah dari Hotels menjadi Hotel
{
    use HasFactory;

    protected $fillable = [
        'nama_hotel',
        'alamat',
        'harga_per_malam',
        'destination_id',
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

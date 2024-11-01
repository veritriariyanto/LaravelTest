<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinations extends Model // Ubah dari Destinations menjadi Destination
{
    use HasFactory;

    protected $fillable = [
        'nama_destinasi',
        'deskripsi',
        'lokasi',
        'htm',
        'image',
    ];
    public function transports()
    {
        return $this->hasMany(Transports::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotels::class);
    }
}

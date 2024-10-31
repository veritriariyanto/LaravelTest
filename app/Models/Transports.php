<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transports extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_transport',
        'tipe_transport',
        'biaya',
        'destination_id',
    ];
    public function destinations()
    {
        return $this->belongsTo(Destinations::class, 'destination_id');
    }
}

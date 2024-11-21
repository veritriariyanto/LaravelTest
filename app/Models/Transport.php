<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_transport',
        'tipe_transport',
        'biaya',
        'destination_id',
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}

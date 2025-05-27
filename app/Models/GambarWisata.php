<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarWisata extends Model
{
    use HasFactory;

    protected $table = 'gambar_wisata';

    protected $fillable = [
        'wisata_id',
        'path_gambar',
        'keterangan'
    ];

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'wisata_id');
    }
}

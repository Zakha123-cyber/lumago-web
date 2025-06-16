<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatWisata extends Model
{
    use HasFactory;

    protected $table = 'tempat_wisata';

    protected $fillable = [
        'admin_id',
        'kategori_id',
        'nama',
        'deskripsi',
        'lokasi',
        'link_maps',
        'jam_operasional',
        'harga_tiket'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function gambarWisata()
    {
        return $this->hasMany(\App\Models\GambarWisata::class, 'wisata_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'wisata_id');
    }

    public function kategori()
    {
        return $this->belongsTo(\App\Models\KategoriWisata::class, 'kategori_id');
    }
}

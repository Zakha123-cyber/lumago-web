<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'order_id',
        'user_id',
        'wisata_id',
        'tanggal_booking',
        'jumlah_tiket',
        'total_bayar',
        'status_pembayaran',
        'status_tiket',
        'qr_code_path',
        'snap_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'wisata_id');
    }

    public function scanValidasi()
    {
        return $this->hasOne(ScanValidasi::class, 'transaksi_id');
    }
}

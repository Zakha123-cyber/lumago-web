<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanValidasi extends Model
{
    use HasFactory;

    protected $table = 'scan_validasi';

    protected $fillable = [
        'transaksi_id',
        'admin_id',
        'waktu_scan',
        'lokasi_scan',
        'status_validasi'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

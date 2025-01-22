<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['barang_id', 'jenis_transaksi', 'jumlah', 'sumber_tujuan', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
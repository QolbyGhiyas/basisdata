<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';

    public $timestamps = false;

    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'PelangganID'
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(detailPenjualanModel::class, 'PenjualanID');
    }

    public function pelanggan()
    {
        return $this->belongsTo('App\Models\PelangganModel', 'PelangganID', 'id');
    }
}

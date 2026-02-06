<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';

    public $timestamps = false;

    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'NomorTelepon'
    ];

    public function penjualan()
    {
        return $this->hasMany('App\Models\PenjualanModel', 'PelangganID', 'id');
    }
}

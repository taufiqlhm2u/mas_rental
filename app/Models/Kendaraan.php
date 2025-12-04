<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    //
    protected $table = 'kendaraan';
    protected $fillable = [
        'kendaraan_nama',
        'kendaraan_tipe',
        'kendaraan_harga_perhari',
        'kendaraan_status',
        'kendaraan_gambar'
    ];

    public $timestamps = false;
    public $primaryKey = 'kendaraan_nomor';
}

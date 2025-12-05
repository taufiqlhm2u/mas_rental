<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $primaryKey = 'pinjam_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'pinjam_tgl',
        'pinjam_tgl_kembali',
        'pinjam_status',
    ];
}

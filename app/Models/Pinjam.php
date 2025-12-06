<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $primaryKey = 'pinjam_id';
    public $timestamps = false;
    protected $fillable = [
        'pinjam_id',
        'user_id',
        'kendaraan_nomor',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'tgl_kembali',
        'pinjam_status',
    ];
}

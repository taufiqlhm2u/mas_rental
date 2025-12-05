<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::paginate(perPage: 8);
        return view('user.kendaraan', ['kendaraan' => $kendaraan]);
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $kendaraan = Kendaraan::where('kendaraan_nama', 'LIKE', "%$cari%")->orWhere('kendaraan_tipe', 'LIKE', "%$cari%")->paginate(5);
        return view('user.kendaraan', ['kendaraan' => $kendaraan]);
    }
}

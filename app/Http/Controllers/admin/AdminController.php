<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Pinjam;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function index()
    {
        $user = User::where('user_status', '=', 2)->count();
        $kendaraan = Kendaraan::all()->count();
        $pinjam = Pinjam::where('pinjam_status', '=', 'dipinjam')->count();
        $today = Pinjam::where('tgl_harus_kembali', '=', date('Y-m-d'))->count();

        $data = [
            'jumlahUser' => $user,
            'jumlahKendaraan' => $kendaraan,
            'jumlahPinjam' => $pinjam,
            'jumlahToday' => $today,
        ];
        
        return view('admin.dashboard', $data);
    }

}

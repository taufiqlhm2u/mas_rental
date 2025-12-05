<?php

namespace App\Http\Controllers\user;

use App\Models\Pinjam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //   dirental
        $rental = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'dipinjam')->count();

        // booking
        $book = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'booking')->count();

        // tengat hari ini
        $tengat = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('tgl_harus_kembali', '=', date('Y-m-d'))->count();

        // telat dari tgl harus kembali
        $telat = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'dipinjam')->where('tgl_harus_kembali', '<', date('Y-m-d'))->count();

        // selesai
        $selesai = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'dikembalikan')->count();
        
        // pinjam yang masih aktif
        $pinjam = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'dipinjam')->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')->get();

         $data = [
            'rental' => $rental,
            'book' => $book,
            'tengat' => $tengat,
            'telat' => $telat,
            'selesai' => $selesai,
            'pinjam' => $pinjam,
        ];

        return view('user.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'cek';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

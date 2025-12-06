<?php

namespace App\Http\Controllers\user;

use App\Models\Pinjam;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rental = Pinjam::where('user_id', '=', auth()->user()->user_id)->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')->orderBy('pinjam_id', 'DESC')->paginate(5);

        // tengat hari ini
        $tengat = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('tgl_harus_kembali', '=', date('Y-m-d'))->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')->get();

        // pinjam
        $pinjam = Pinjam::where('user_id', '=', auth()->user()->user_id)->where('pinjam_status', '=', 'dipinjam')->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')->get();

        $data = [
            'rental' => $rental,
            'tengat' => $tengat,
            'pinjam' => $pinjam,
        ];
        $title = 'Masrental';
        $text = 'Apakah kamu ingin batalkan kendaraan ini?';
        confirmDelete($title, $text);
        return view('user.pinjam', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function book(int $nomor)
    {
        $k = Kendaraan::where('kendaraan_nomor', '=', $nomor)->first();
       if (!$k) {
           Alert::error('Gagal', 'Kendaraan tidak ditemukan');
           return redirect()->route('userPinjam');
       }

         Pinjam::create([
            'user_id' => auth()->user()->user_id,
            'pinjam_status' => 'booking',
            'kendaraan_nomor' => $k->kendaraan_nomor,
        ]);


        Kendaraan::where('kendaraan_nomor', '=', $nomor)->update([
            'kendaraan_status' => 'booking'
        ]);

        Alert::success('Berhasil', 'Kendaraan berhasil di booking, datang ke masrental untuk proses selanjutnya, apabila 3 hari tidak datang maka booking akan dibatalkan');
        return redirect()->route('userPinjam');
    }

   
    public function cancel(string $id)
    {
        $p = Pinjam::where('pinjam_id', '=', $id)->first();
        if (!$p) {
            Alert::error('Gagal', 'Data pinjam tidak ditemukan');
            return redirect()->route('userPinjam');
        }

        Kendaraan::where('kendaraan_nomor', '=', $p->kendaraan_nomor)->update([
            'kendaraan_status' => 'ready'
        ]);

        Pinjam::where('pinjam_id', '=', $id)->update([
            'pinjam_status' => 'dibatalkan'
        ]);

        Alert::success('Berhasil', 'Booking kendaraan berhasil dibatalkan');
        return redirect()->route('userPinjam');
    }
}

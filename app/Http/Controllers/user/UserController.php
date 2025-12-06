<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

    public function profile(Request $request)
    {
        User::where('user_id', '=', auth()->user()->user_id)->update([
            'user_nama' => $request->nama,
            'username' => $request->username,
            'user_alamat' => $request->alamat,
        ]);

        Alert::success('Berhasil', 'Profile berhasil diupdate');
        return redirect()->route('userDashboard');
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required',
        ]);

        if (!\Hash::check($request->oldpass, auth()->user()->user_password)) {

            Alert::error('Gagal', 'Password lama tidak sesuai');
            return redirect()->route('userDashboard');
        }

        User::where('user_id', '=', auth()->user()->user_id)->update([
            'user_password' => Hash::make($request->newpass),
        ]);

        Alert::success('Berhasil', 'Password berhasil diubah');
        return redirect()->route('userDashboard');
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
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

        $pinjam = Pinjam::join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')
            ->join('users', 'pinjam.user_id', '=', 'users.user_id')
            ->orderBy('pinjam.pinjam_id', 'DESC')
            ->paginate(5);

        $user = User::where('user_status', 'USER')->get();
        $kendaraan = Kendaraan::where('kendaraan_status', '=', 'ready')->get();

        $data = [
            'pinjam' => $pinjam,
            'user' => $user,
            'kendaraan' => $kendaraan
        ];

        $title = 'Hapus data';
        $text = 'Apakah yakin ingin mengahpus data peminjaman user?';
        confirmDelete($title, $text);
        return view('admin.pinjam', $data);
    }


    public function search(Request $request)
    {
        $key = $request->search;
        $pinjam = Pinjam::where('pinjam.tgl_pinjam', 'LIKE', "%$key%")->orWhere('users.user_nama', 'LIKE', "%$key%")->orWhere('kendaraan.kendaraan_nama', 'LIKE', "%$key%")->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')
            ->join('users', 'pinjam.user_id', '=', 'users.user_id')
            ->orderBy('pinjam.pinjam_id', 'DESC')
            ->paginate(5);

            $user = User::where('user_status', 'USER')->get();
        $kendaraan = Kendaraan::where('kendaraan_status', '=', 'ready')->get();

        $data = [
            'pinjam' => $pinjam,
            'user' => $user,
            'kendaraan' => $kendaraan
        ];

         $title = 'Hapus data';
        $text = 'Apakah yakin ingin mengahpus data peminjaman user?';
        confirmDelete($title, $text);

        return view('admin.pinjam', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pinjam::create([
            'user_id' => $request->user,
            'kendaraan_nomor' => $request->kendaraan,
            'tgl_pinjam' => ($request->tgl_pinjam) ? $request->tgl_pinjam : NULL,
            'tgl_harus_kembali' => ($request->tgl_harus_kembali) ? $request->tgl_harus_kembali : NULL,
            'tgl_kembali' => ($request->tgl_kembali) ? $request->tgl_kembali : NULL,
            'pinjam_status' => $request->status,
        ]);

        $status = '';

        if ($request->status == 'booking') {
            $status = 'booking';
        } elseif ($request->status == 'dipinjam') {
            $status = 'dirental';
        } else {
            $status = 'ready';
        }

        Kendaraan::where('kendaraan_nomor', '=', $request->kendaraan)->update([
            'kendaraan_status' => $status,
        ]);


        Alert::success('Berhasil', 'Data pinjam berhasil dibuat');
        return redirect()->route('adminPinjam');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Pinjam::where('pinjam_id', '=', $request->pinjam_id)->update([
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_harus_kembali' => (isset($request->tgl_harus_kembali)) ? $request->tgl_harus_kembali : NULL,
            'tgl_kembali' => (isset($request->tgl_kembali)) ? $request->tgl_kembali : NULL,
            'pinjam_status' => $request->status,
        ]);

        $idK = Pinjam::where('pinjam_id', '=', $request->pinjam_id)->first();
        $status = '';

        if ($request->status == 'booking') {
            $status = 'booking';
        } elseif ($request->status == 'dipinjam') {
            $status = 'dirental';
        } else {
            $status = 'ready';
        }

        Kendaraan::where('kendaraan_nomor', '=', $idK->kendaraan_nomor)->update([
            'kendaraan_status' => $status,
        ]);

        Alert::success('Berhasil', 'Data pinjam berhasil diupdate');
        return redirect()->route('adminPinjam');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pinjam = Pinjam::where('pinjam_id', '=', $id)->first();


        Kendaraan::where('kendaraan_nomor', '=', $pinjam->kendaraan_nomor)->update([
            'kendaraan_status' => 'ready'
        ]);

        Pinjam::where('pinjam_id', '=', $id)->delete();
        Alert::success('Berhasil', 'Data pinjam berhasil diupdate');
        return redirect()->route('adminPinjam');
    }
}

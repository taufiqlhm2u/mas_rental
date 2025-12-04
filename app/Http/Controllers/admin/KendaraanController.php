<?php

namespace App\Http\Controllers\admin;

use App\Models\Kendaraan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $k = Kendaraan::paginate(3);
        $title = 'Hapus User!';
        $text = "Kamu yakin ingin mengahapusnya?";
        confirmDelete($title, $text);
        return view('admin.kendaraan', ['kendaraan' => $k]);
    }

    public function search()
    {
        $keyword = request()->search;
        $k = Kendaraan::where('kendaraan_nama', 'like', "%$keyword%")
            ->orWhere('kendaraan_tipe', 'like', "%$keyword%")
            ->paginate(3);
        $title = 'Hapus User!';
        $text = "Kamu yakin ingin mengahapusnya?";
        confirmDelete($title, $text);
        return view('admin.kendaraan', ['kendaraan' => $k]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ], [
            'nama.required' => 'Nama kendaraan wajib diisi!',
            'nama.max' => 'Panjang maksimal nama kendaraan adalah 100 karakter!',
            'tipe.required' => 'Tipe kendaraan wajib diisi!',
            'harga.required' => 'Harga perhari wajib diisi!',
            'harga.integer' => 'Harga perhari harus berupa angka!',
            'gambar.required' => 'Gambar kendaraan wajib diunggah!',
            'gambar.image' => 'File yang diunggah harus berupa gambar!',
            'gambar.mimes' => 'Format gambar harus berupa png, jpg, jpeg, atau webp!',
            'gambar.max' => 'Ukuran maksimal gambar adalah 2MB!'
        ]);
        // upload gambar
        $gambar = $request->file('gambar');
        $gambarNama = time() . '_' . Str::random(8) . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('img/upload'), $gambarNama);

        // simpan ke database
        Kendaraan::create([
            'kendaraan_nama' => $request->nama,
            'kendaraan_tipe' => $request->tipe,
            'kendaraan_harga_perhari' => $request->harga,
            'kendaraan_gambar' => $gambarNama
        ]);

        Alert::success('Berhasil', 'Data kendaraan berhasil ditambahkan!');
        return redirect()->route('adminKendaraan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|string',
            'harga' => 'required|integer',
            'status' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg,webp|max:2048'
        ], [
            'nama.required' => 'Nama kendaraan wajib diisi!',
            'nama.max' => 'Panjang maksimal nama kendaraan adalah 100 karakter!',
            'tipe.required' => 'Tipe kendaraan wajib diisi!',
            'harga.required' => 'Harga perhari wajib diisi!',
            'harga.integer' => 'Harga perhari harus berupa angka!',
            'status.required' => 'Harga perhari wajib diisi!',
            'gambar.image' => 'File yang diunggah harus berupa gambar!',
            'gambar.mimes' => 'Format gambar harus berupa png, jpg, jpeg, atau webp!',
            'gambar.max' => 'Ukuran maksimal gambar adalah 2MB!'
        ]);

        try {
            //  cek apakah ada gambar yang diupload
            $gambar = '';
            if ($request->gambar) {
                // upload gambar baru
                $gambarFile = $request->file('gambar');
                $gambar = time() . '_' . Str::random(8) . '.' . $gambarFile->getClientOriginalExtension();
                $gambarFile->move(public_path('img/upload'), $gambar);

                // hapus gambar lama
                $oldGambar = public_path('img/upload/') . $request->old_gambar;
                if (file_exists($oldGambar)) {
                    unlink($oldGambar);
                }
            } else {
                $gambar = $request->old_gambar;
            }

            // update data
            Kendaraan::where('kendaraan_nomor', $request->kendaraan_nomor)->update([
                'kendaraan_nama' => $request->nama,
                'kendaraan_tipe' => $request->tipe,
                'kendaraan_harga_perhari' => $request->harga,
                'kendaraan_status' => $request->status,
                'kendaraan_gambar' => $gambar
            ]);

            Alert::success('Berhasil', 'Data kendaraan berhasil diupdate!');

        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui data kendaraan!');
        }

        return redirect()->route('adminKendaraan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::where('kendaraan_nomor', $id)->first();
        if ($kendaraan) {
            // hapus gambar dari folder
            $gambarPath = public_path('img/upload/') . $kendaraan->kendaraan_gambar;
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
            // hapus data kendaraan dari database
            Kendaraan::where('kendaraan_nomor', $id)->delete();
            Alert::success('Berhasil', 'Data kendaraan berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Data kendaraan tidak ditemukan!');
        }

        return redirect()->route('adminKendaraan');
    }
}

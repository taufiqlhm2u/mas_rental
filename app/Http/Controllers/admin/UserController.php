<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = User::where('user_id', '!=', Auth::user()->user_id)->orderBy('user_nama', 'ASC')->paginate(10);

        $title = 'Hapus User!';
        $text = "Kamu yakin ingin mengahapusnya?";
        confirmDelete($title, $text);
        return view('admin.user', ['user' => $user]);
    }

    public function search(Request $request)
    {
        $key = $request->search;
        $user = User::where(function ($q) use ($key) {
            $q->where('user_nama', 'LIKE', "%$key%")->orWhere('username', 'LIKE', "%$key%")->orWhere('user_alamat', 'LIKE', "%$key%");
        })->paginate(5);
        return view('admin.user', ['user' => $user]);
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
         $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'username wajib di isi',
            'nama.required' => 'nama wajib di isi',
            'alamat.required' => 'alamat wajib di isi',
            'password.required' => 'password wajib di isi',
        ]);

        // cek ada username yang sama tidak
        $user = User::where('username', '=', $request->username)->first();

        if ($user) {
            Alert::error('Yahhh', 'Username telah dipakai, buat username lain');
            return back();
        }

        User::create([
        'user_nama' => $request->nama,
        'username' => $request->username,
        'user_alamat' => $request->alamat,
        'user_password' => Hash::make($request->password),
        ]);

        Alert::success('Horee', 'Data user berhasil ditambahkan');
        return redirect()->route('adminUser');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy($id)
    {
        //
        User::where('user_id', '=', $id)->delete();

        Alert::success('Hapus data', "User id = $id , berhasil dihapus");
        return redirect()->route('adminUser');
       
    }
}

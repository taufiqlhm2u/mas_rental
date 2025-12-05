<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{

    // untuk menampilkan view login
    public function index()
    {
        return view('auth.login');
    }


    // mengecek login
    public function cekLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'email wajib di isi',
            'password.required' => 'password wajib di isi'
        ]);

        // cek ke database
        $user = User::where('username', '=', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        if (!Hash::check($request->password,$user->user_password)) {
            return back()->with('error', 'Masukan password dengan benar');
        }
        
        Auth::login($user);
        request()->session()->regenerate();

        // cek user status dan redirect 
            if ($user->user_status == 'admin') {
                Alert::info('Selamat datang!');
                return redirect()->route('adminDashboard');
            } else {
                Alert::info('Selamat datang!');
                return redirect()->route('userDashboard');
            }
       
    }

    // daftar
    public function daftar()
    {
        return view('auth.daftar');
    }

    // daftar user

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
            return back()->with('error', 'Pilih username yang lain');
        }

        // kalo tidak ada baru tambahkan, dan nanti user akan login
        User::create([
            'username' => $request->username,
            'user_nama' => $request->nama,
            'user_alamat' => $request->alamat,
            'user_password' => Hash::make($request->password),
            'user_status' => 'user',
        ]);

        Alert::success('Yeay', 'Kamu berhasil daftar. Login dulu ya');
        return redirect('/login');
    }

    // logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    
}

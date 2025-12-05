<?php

namespace App\Http\Controllers\user;

use App\Models\Pinjam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rental = Pinjam::where('user_id', '=', auth()->user()->user_id)->join('kendaraan', 'pinjam.kendaraan_nomor', '=', 'kendaraan.kendaraan_nomor')->get();
        return view('user.pinjam', ['rental' => $rental]);
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
        return $id;
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

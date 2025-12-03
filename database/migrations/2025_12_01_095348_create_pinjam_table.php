<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjam', function (Blueprint $table) {
            $table->id('pinjam_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kendaraan_nomor');
            $table->enum('pinjam_status', ['booking', 'dipinjam', 'dikembalikan', 'dibatalkan']);
            $table->date('tgl_pinjam');
            $table->date('tgl_harus_kembali');
            $table->date('tgl_kembali');

            // foreign key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('kendaraan_nomor')->references('kendaraan_nomor')->on('kendaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam');
    }
};

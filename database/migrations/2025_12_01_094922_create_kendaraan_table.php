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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('kendaraan_nomor');
            $table->string('kendaraan_nama', 100);
            $table->string('kendaraan_tipe');
            $table->integer('kendaraan_harga_perhari');
            $table->enum('kendaraan_status', ['ready', 'booking', 'dirental'])->default('ready');
            $table->string('kendaraan_gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};

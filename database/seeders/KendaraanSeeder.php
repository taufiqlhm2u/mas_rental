<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contoh = [
            [
                'nama' => 'Toyota Avanza',
                'tipe' => 'MPV',
                'harga_perhari' => 400000,
                'status' => 'ready',
                'gambar' => 'avanza.png'
            ],
            [
                'nama' => 'BMW X5',
                'tipe' => 'SUV',
                'harga_perhari' => 500000,
                'status' => 'ready',
                'gambar' => 'bmwx5.avif'
            ],
            [
                'nama' => 'Mercedes C-Class',
                'tipe' => 'Sedan',
                'harga_perhari' => 450000,
                'status' => 'ready',
                'gambar' => 'mercy.webp'
            ],
            [
                'nama' => 'BMW e36',
                'tipe' => 'Sedan',
                'harga_perhari' => 450000,
                'status' => 'ready',
                'gambar' => 'bmwe36.webp'
            ],
            [
                'nama' => 'Honda Civic',
                'tipe' => 'Sedan',
                'harga_perhari' => 350000,
                'status' => 'ready',
                'gambar' => 'civic.jpg'
            ]
        ];

        foreach ($contoh as $c) {
            Kendaraan::create([
                'kendaraan_nama' => $c['nama'],
                'kendaraan_tipe' => $c['tipe'],
                'kendaraan_harga_perhari' => $c['harga_perhari'],
                'kendaraan_status' => $c['status'],
                'kendaraan_gambar' => $c['gambar'],
            ]);
        }
    }
}

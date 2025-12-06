<?php

namespace Database\Seeders;

use App\Models\Pinjam;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Pinjam::create([
                'user_id' => 22,
                'kendaraan_nomor' => rand(1, 5),
                'tgl_pinjam' => now()->subDays(rand(1, 30))->toDateString(),
                'tgl_harus_kembali' => now()->addDays(rand(1, 30))->toDateString(),
                'tgl_kembali' => now()->addDays(rand(1, 30))->toDateString(),
                'pinjam_status' => 'dikembalikan',
            ]);
        }
    }
}

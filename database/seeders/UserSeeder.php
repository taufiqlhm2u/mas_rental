<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // menambahkan data dummy dengan faker

        $faker = Faker::create('id_ID');


        // buat untuk admin
        User::create([
            'user_nama' => 'Apollonia',
            'user_alamat' => $faker->address(),
            'username' => 'aplv34',
            'user_password' => Hash::make('aplv'),
            'user_status' => 'admin'
        ]);
        
        // membuat beberapa user

        User::create([
            'user_nama' => 'taufiqul',
            'user_alamat' => $faker->address(),
            'username' => 'taufiqlhm2u',
            'user_password' => Hash::make('taufiq'),
            'user_status' => 'user'
        ]);

        for ($a = 1; $a <= 20; $a++) {
            User::create([
                'user_nama' => $faker->name(),
                'user_alamat' => $faker->address(),
                'username' => $faker->userName(),
                'user_password' => Hash::make(1234),
                'user_status' => 'user'
            ]);
        }
    }
}

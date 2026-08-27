<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\User;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaJenis = ['Makanan', 'Minuman', 'Kosmetik', 'Pakaian', 'Elektronik'];

        $users = User::all();

        foreach ($users as $user) {
            foreach ($namaJenis as $nama) {
                Jenis::create([
                    'user_id'    => $user->id,
                    'nama_jenis' => $nama,
                ]);
            }
        }
    }
}
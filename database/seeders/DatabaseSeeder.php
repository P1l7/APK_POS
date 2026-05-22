<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use Illuminate\Database\Seeder;
use App\models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::Create(

            RoleSeeder::class,
            UserSeeder::class,
            ProdukSeeder::class,
            PenjualanSeeder::class
        );


        Role::Create(

            ['name' => 'kasir']
        );
    }



}

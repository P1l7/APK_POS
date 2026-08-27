<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'role_id' => Role::where('name', 'admin')->value('id'),
        ]);

        User::factory()->count(2)->create();
    }
}
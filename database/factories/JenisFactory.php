<?php

namespace Database\Factories;

use App\Models\Jenis;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisFactory extends Factory
{
    public function definition(): array
    {
        return [
             'user_id' => \App\Models\User::factory(),
+        'nama_jenis' => $this->faker->randomElement(['Makanan', 'Minuman', 'Kosmetik', 'Pakaian', 'Elektronik']),
        ];
    }
}
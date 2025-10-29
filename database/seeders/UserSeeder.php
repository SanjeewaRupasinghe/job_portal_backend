<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'c@mail.com';
        if (!User::where('email', $email)->exists()) {
            User::factory()->create([
                'email' => $email,
                'role'  => 'candidate',
            ]);
        }

        $email = 'e@mail.com';
        if (!User::where('email', $email)->exists()) {
            User::factory()->create([
                'email' => $email,
                'role'  => 'employer',
            ]);
        }
    }
}

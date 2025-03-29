<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'iREX First Admin',
            'username' => 'irex_firstadmin',
            'email' => 'test@irex.net',
            'password' => Hash::make('irex_password'),
            'remember_token' => Str::random(10),
            'is_active' => true,
            'is_admin' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'iREX First Admin',
            'username' => 'irex_firstadmin',
            'email' => 'test@irex.net',
            'is_active' => true,
            'is_admin' => true,
        ]);
    }
}

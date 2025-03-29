<?php

namespace Database\Seeders;

use App\Models\FaqList;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(FaqListSeeder::class);
    }
}

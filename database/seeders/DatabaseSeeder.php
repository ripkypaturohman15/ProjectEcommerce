<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            // Anda bisa menambahkan CategorySeeder dan ProductSeeder nanti jika ingin data dummy
        ]);
    }
}
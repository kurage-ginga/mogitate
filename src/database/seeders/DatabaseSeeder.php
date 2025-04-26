<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductTableSeeder::class,
            SeasonTableSeeder::class,
        ]);

    }
}

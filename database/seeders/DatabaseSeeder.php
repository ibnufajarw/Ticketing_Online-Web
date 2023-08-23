<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KampusSeeder::class,
            KategoriSeeder::class,
            SliderSeeder::class,
            AcaraSeeder::class,
            TiketSeeder::class,
            KeuntunganSeeder::class,
            MetodePembayaranSeeder::class,
        ]);
    }
}

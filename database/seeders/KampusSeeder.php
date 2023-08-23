<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kampuses = [
            [
                'nama' => 'Brawijaya Kusuma',
                'thumbnail' => 'image/kampus/brawijaya.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Barata Yudha',
                'thumbnail' => 'image/kampus/barata.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('kampus')->insert($kampuses);
    }
}

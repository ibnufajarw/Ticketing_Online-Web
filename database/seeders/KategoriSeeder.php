<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategories = [
            [
                'nama' => 'Teknologi',
                'thumbnail' => 'image/kategori/technology.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Edukasi',
                'thumbnail' => 'image/kategori/education.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'E-Sport',
                'thumbnail' => 'image/kategori/tournament.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kesehatan',
                'thumbnail' => 'image/kategori/healthcare.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Olahraga',
                'thumbnail' => 'image/kategori/culture.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('kategori')->insert($kategories);
    }
}

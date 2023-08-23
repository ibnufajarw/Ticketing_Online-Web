<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'judul' => 'Acara Teknologi Terbaru',
                'deskripsi' => 'Ikuti acara teknologi terbaru dan pelajari Trend terkini dalam industri IT.',
                'thumbnail' => 'image/slider/slide-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Program Edukasi Online',
                'deskripsi' => 'Daftar sekarang untuk program edukasi online kami dan tingkatkan pengetahuan Anda.',
                'thumbnail' => 'image/slider/slide-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('sliders')->insert($sliders);
    }
}

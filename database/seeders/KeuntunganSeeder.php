<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuntunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keuntungans = [
            [
                'tiket_id' => 3,
                'keuntungan' => 'Akses awal ke lokasi acara',
            ],
            [
                'tiket_id' => 3,
                'keuntungan' => 'Akses ke workshop eksklusif',
            ],
            [
                'tiket_id' => 3,
                'keuntungan' => 'Tempat duduk terdepan di baris depan',
            ],
            [
                'tiket_id' => 3,
                'keuntungan' => 'Peluang jaringan dengan pakar industri',
            ],
            [
                'tiket_id' => 3,
                'keuntungan' => 'Konsumsi gratis selama istirahat',
            ],
        ];
        
        DB::table('keuntungans')->insert($keuntungans);
    }
}

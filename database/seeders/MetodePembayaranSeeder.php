<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodes = [
            [
                'logo' => null,
                'nama' => 'BRI',
                'jenis' => 'bank',
                'no_rekening' => '00112233',
                'atas_nama' => 'Andrian',
            ],
            [
                'logo' => null,
                'nama' => 'BCA',
                'jenis' => 'bank',
                'no_rekening' => '100200300',
                'atas_nama' => 'Andrian',
            ],
        ];
        DB::table('metode_pembayaran')->insert($metodes);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisTikets = [
            [
                'acara_id' => '1',
                'nama_paket' => 'Berbayar',
                'kuota' => '50',
                'is_free' => 0,
            ],
            [
                'acara_id' => '2',
                'nama_paket' => 'Gratis',
                'kuota' => '50',
                'is_free' => 1,
            ]
        ];
        DB::table('jenis_tiket')->insert($jenisTikets);
        $tikets = [
            [
                'jenis_tiket_id' => '1',
                'kode' => 'VIP',
                'tier' => 'A1',
                'kursi' => '3',
                'harga' => '100000',
            ],
            [
                'jenis_tiket_id' => '1',
                'kode' => 'VIP',
                'tier' => 'A1',
                'kursi' => '2',
                'harga' => '120000',
            ],
            [
                'jenis_tiket_id' => '1',
                'kode' => 'VIP',
                'tier' => 'A1',
                'kursi' => '1',
                'harga' => '150000',
            ],
            [
                'jenis_tiket_id' => '2',
                'kode' => 'Reguler',
                'tier' => 'A1',
                'kursi' => '10',
                'harga' => '0',
            ],
            [
                'jenis_tiket_id' => '2',
                'kode' => 'Reguler',
                'tier' => 'A1',
                'kursi' => '9',
                'harga' => '0',
            ],
            [
                'jenis_tiket_id' => '2',
                'kode' => 'Reguler',
                'tier' => 'A1',
                'kursi' => '8',
                'harga' => '0',
            ],
        ];
        DB::table('tiket')->insert($tikets);
    }
}

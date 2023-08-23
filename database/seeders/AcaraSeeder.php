<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk acara dalam kategori Teknologi
        DB::table('acara')->insert([
            'kategori_id' => 1,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Seminar Google Cloud',
            'slug' => 'seminar-google-cloud',
            'thumbnail' => 'image/acara/gcloud.png',
            'deskripsi' => 'Selamat datang di Seminar Google Cloud! Acara ini didedikasikan untuk memperluas pengetahuan Anda tentang solusi-solusi cloud terkini dari Google Cloud Platform (GCP). Dalam dunia yang terus berkembang dengan cepat, teknologi cloud menjadi kunci untuk memaksimalkan inovasi, meningkatkan efisiensi, dan mengatasi tantangan bisnis.',
            'waktu_mulai' => Carbon::now()->addDays(7),
            'durasi_menit_estimasi' => 120,
            'kuota' => 10,
            'status' => 'published',
            'dress_code' => 'Formal',
            'peraturan' => 'Kehadiran Tepat Waktu: Peserta diharapkan hadir tepat waktu sesuai dengan jadwal yang telah ditentukan. Keterlambatan dapat mengganggu jalannya acara dan sesi yang sedang berlangsung.',
            'foto_stage' => null,
            'view_count' => 0,
            'alamat' => 'Seminar Center, Jalan Teknologi No. 123, Jakarta, DKI Jakarta, 12345',
            'latitude' => '6.1754',
            'longitude' => '106.8272',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('acara')->insert([
            'kategori_id' => 1,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Hackathon CodeJam 2023',
            'slug' => 'hackathon-codejam-2023',
            'thumbnail' => 'image/acara/hackaton.png',
            'deskripsi' => 'Sudah siap menghadapi tantangan coding terbesar tahun ini? Hackathon CodeJam 2023 adalah ajang kompetisi pemrograman yang diadakan untuk para developer muda yang ingin memamerkan kemampuan mereka dalam mengembangkan solusi kreatif untuk masalah-masalah dunia nyata.',
            'waktu_mulai' => Carbon::now()->addDays(8),
            'durasi_menit_estimasi' => 720,
            'kuota' => 50,
            'status' => 'published',
            'dress_code' => 'Kasual',
            'peraturan' => 'Peserta diwajibkan membawa laptop sendiri dengan perangkat lunak yang diperlukan sudah diinstal sebelumnya. Harap mengisi formulir pendaftaran dengan lengkap.',
            'foto_stage' => null,
            'view_count' => 0,
            'alamat' => 'TechHub Building, Jalan Coding No. 987, Bandung, Jawa Barat, 54321',
            'latitude' => '-6.9147',
            'longitude' => '107.6098',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Edukasi
        DB::table('acara')->insert([
            'kategori_id' => 2,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Workshop Pemrograman Dasar',
            'slug' => 'workshop-pemrograman-dasar',
            'thumbnail' => 'image/acara/edukasi.png',
            'deskripsi' => 'Selamat datang di Workshop Pemrograman Dasar! Acara ini akan membantu Anda memahami konsep dasar dalam pemrograman, mulai dari sintaksis hingga algoritma. Tidak diperlukan pengetahuan pemrograman sebelumnya. Ayo bergabung dan tingkatkan keterampilan Anda!',
            'waktu_mulai' => Carbon::now()->addDays(14),
            'durasi_menit_estimasi' => 180,
            'kuota' => 50,
            'status' => 'published',
            'dress_code' => 'Casual',
            'peraturan' => 'Peralatan Dibawa Sendiri: Peserta diharapkan membawa laptop sendiri untuk mengikuti praktikum pemrograman.',
            'foto_stage' => null,
            'view_count' => 0,
            'alamat' => 'Ruang Workshop 2B, Gedung Edukasi, Universitas ABC, Bandung, Jawa Barat, 67890',
            'latitude' => '-6.9271',
            'longitude' => '107.6098',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // E-Sport
        DB::table('acara')->insert([
            'kategori_id' => 3,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Turnamen Mobile Legends',
            'slug' => 'turnamen-mobile-legends',
            'thumbnail' => 'image/acara/esport.png',
            'deskripsi' => 'Siap-siap untuk ikut serta dalam Turnamen Mobile Legends! Tunjukkan kemampuan permainan tim dan strategi Anda dalam kompetisi ini. Hadiah menarik menanti pemenang! Daftarkan tim Anda sekarang!',
            'waktu_mulai' => Carbon::now()->addDays(21),
            'durasi_menit_estimasi' => 240,
            'kuota' => 16, // Contoh kuota peserta
            'status' => 'published',
            'dress_code' => 'Jersey Tim',
            'peraturan' => 'Pendaftaran Tim: Setiap tim harus terdiri dari 5 pemain. Pastikan untuk mendaftarkan tim Anda sebelum batas waktu pendaftaran.',
            'foto_stage' => null,
            'view_count' => 0,
            'alamat' => 'Aula E-Sport, Gedung Olahraga, Universitas XYZ, Surabaya, Jawa Timur, 45678',
            'latitude' => '-7.2575',
            'longitude' => '112.7521',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // kesehatan

        DB::table('acara')->insert([
            'kategori_id' => 4,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Webinar AI in Healthcare',
            'slug' => 'webinar-ai-in-healthcare',
            'thumbnail' => 'image/acara/healthcare.png',
            'deskripsi' => 'Saatnya untuk memahami bagaimana kecerdasan buatan (AI) dapat mengubah industri kesehatan. Webinar ini akan membahas penerapan teknologi AI dalam diagnosis penyakit, perawatan pasien, dan penelitian medis. Bergabunglah dengan para pakar dalam bidang ini dan jangan lewatkan kesempatan untuk belajar lebih banyak.',
            'waktu_mulai' => Carbon::now()->addDays(15),
            'durasi_menit_estimasi' => 90,
            'kuota' => 200,
            'status' => 'published',
            'dress_code' => 'Kasual',
            'peraturan' => 'Peserta diharapkan memiliki pengetahuan dasar tentang kecerdasan buatan. Webinar akan diselenggarakan melalui platform konferensi online.',
            'foto_stage' => 'webinar-stage.jpg',
            'view_count' => 0,
            'alamat' => 'Health Care Building, Jalan Coding No. 987, Bandung, Jawa Barat, 54321',
            'latitude' => '-6.9147',
            'longitude' => '107.6098',
            'latitude' => null,
            'longitude' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Olahraga
        DB::table('acara')->insert([
            'kategori_id' => 5,
            'user_id' => 2,
            'kampus_id' => 1,
            'judul' => 'Marathon Universitas',
            'slug' => 'marathon-universitas',
            'thumbnail' => 'image/acara/olahraga.png',
            'deskripsi' => 'Ayo ikuti Marathon Universitas dan tunjukkan kebugaran fisik Anda! Rute melalui kampus akan memberikan pengalaman berlari yang seru. Berbagai kategori tersedia, termasuk 5K, 10K, dan Half Marathon.',
            'waktu_mulai' => Carbon::now()->addDays(28),
            'durasi_menit_estimasi' => 120,
            'kuota' => 200, // Contoh kuota peserta
            'status' => 'published',
            'dress_code' => 'Pakaian Olahraga',
            'peraturan' => 'Pendaftaran Peserta: Peserta harus mendaftar sebelum tanggal batas pendaftaran untuk mendapatkan nomor lomba dan jersey acara.',
            'foto_stage' => null,
            'view_count' => 0,
            'alamat' => 'Area Lapangan Olahraga, Universitas LMN, Yogyakarta, DIY, 78901',
            'latitude' => '-7.7945',
            'longitude' => '110.3657',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

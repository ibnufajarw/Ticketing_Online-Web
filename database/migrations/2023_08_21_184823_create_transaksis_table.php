<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tiket_id');
            $table->unsignedBigInteger('acara_id');
            $table->unsignedBigInteger('user_id');

            $table->string('kode_transaksi')->unique();
            $table->string('jenis_pembayaran')->nullable();
            $table->string('token_pembayaran')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->string('url_pembayaran')->nullable();
            $table->string('url_invoice')->nullable();
            $table->string('durasi_pembayaran')->nullable()->comment('menit'); //menit
            $table->string('diskon')->nullable();
            $table->string('jumlah_dibayar')->nullable();
            $table->string('jumlah_diterima_disesuaikan')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->string('harga');
            $table->string('batas_pembayaran');
            $table->string('total_pembayaran');
            $table->enum('status', ['MENUNGGU', 'DIBAYAR', 'DITOLAK', 'KADALUARSA', 'GAGAL']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('acara_id')
                ->references('id')
                ->on('acara');
            $table->foreign('tiket_id')
                ->references('id')
                ->on('tiket');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

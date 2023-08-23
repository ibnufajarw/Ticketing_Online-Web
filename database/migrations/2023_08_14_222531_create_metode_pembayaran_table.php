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
        Schema::create('metode_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('nama');
            $table->enum('jenis', ['dompet_digital', 'bank']);
            $table->string('no_rekening');
            $table->string('atas_nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayaran');
    }
};

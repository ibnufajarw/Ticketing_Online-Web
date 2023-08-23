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
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jenis_tiket_id')->unsigned();
            $table->string('kode');
            $table->string('tier')->nullable();
            $table->string('kursi')->nullable();
            $table->bigInteger('harga')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('jenis_tiket_id')
                    ->references('id')
                    ->on('jenis_tiket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};

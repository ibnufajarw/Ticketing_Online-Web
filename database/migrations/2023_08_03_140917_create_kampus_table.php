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
        Schema::create('kampus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lokasi_id')->nullable()->unsigned();
            $table->string('thumbnail')->nullable();
            $table->string('nama');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lokasi_id')
                    ->references('id')
                    ->on('lokasi')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampus');
    }
};

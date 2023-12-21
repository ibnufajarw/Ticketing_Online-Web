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
        Schema::create('acara', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('kampus_id')->unsigned()->nullable();
            $table->string('judul');
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->integer('durasi_menit_estimasi')->nullable();
            $table->integer('kuota');
            $table->enum('status', ['draft','published']);
            $table->string('dress_code')->nullable();
            $table->string('kontak')->nullable();
            $table->string('social_media')->nullable();
            $table->text('peraturan')->nullable();
            $table->string('foto_stage')->nullable();
            $table->integer('view_count')->default(0);
            $table->text('alamat')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kategori_id')
                    ->references('id')
                    ->on('kategori');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->foreign('kampus_id')
                    ->references('id')
                    ->on('kampus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acara');
    }
};

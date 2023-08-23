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
        Schema::create('keuntungans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tiket_id')->unsigned();
            $table->foreign('tiket_id')
                    ->references('id')
                    ->on('tiket');
            $table->text('keuntungan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuntungans');
    }
};

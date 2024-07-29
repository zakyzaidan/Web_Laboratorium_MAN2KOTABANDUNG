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
        Schema::create('kimia_materi_bahan', function (Blueprint $table) {

            $table->id('id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('t_kimia_inventarisasi_bahan_id');
            $table->timestamps();
            $table->foreign('materi_id')->references('id_materi')->on('materi')->onDelete('cascade');
            $table->foreign('t_kimia_inventarisasi_bahan_id')->references('id_t_inventarisasi_bahan')->on('t_kimia_inventarisasi_bahan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kimia_materi_bahan');
    }
};

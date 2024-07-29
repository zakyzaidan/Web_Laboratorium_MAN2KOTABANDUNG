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
        Schema::create('fisika_materi_alat', function (Blueprint $table) {

            $table->id('id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('t_fisika_inventarisasi_alat_id');
            $table->timestamps();
            $table->foreign('materi_id')->references('id_materi')->on('materi')->onDelete('cascade');
            $table->foreign('t_fisika_inventarisasi_alat_id')->references('id_t_inventarisasi_alat')->on('t_fisika_inventarisasi_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fisika_materi_alat');
    }
};

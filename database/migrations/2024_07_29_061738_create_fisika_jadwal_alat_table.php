<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fisika_jadwal_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_praktikum_id');
            $table->unsignedBigInteger('alat_id');
            $table->integer('jumlah');

            // Foreign key constraints
            $table->foreign('jadwal_praktikum_id')->references('id_t_jadwal_praktikum')->on('t_fisika_jadwal_praktikum')->onDelete('cascade');
            $table->foreign('alat_id')->references('id_t_inventarisasi_alat')->on('t_fisika_inventarisasi_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fisika_jadwal_alat');
    }
};
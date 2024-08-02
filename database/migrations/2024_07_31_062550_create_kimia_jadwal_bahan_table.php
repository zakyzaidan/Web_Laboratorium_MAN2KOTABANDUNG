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
        Schema::create('kimia_jadwal_bahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_praktikum_id');
            $table->unsignedBigInteger('bahan_id');
            $table->integer('jumlah');

            // Foreign key constraints
            $table->foreign('jadwal_praktikum_id')->references('id_t_jadwal_praktikum')->on('t_kimia_jadwal_praktikum')->onDelete('cascade');
            $table->foreign('bahan_id')->references('id_t_inventarisasi_bahan')->on('t_kimia_inventarisasi_bahan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kimia_jadwal_bahan');
    }
};
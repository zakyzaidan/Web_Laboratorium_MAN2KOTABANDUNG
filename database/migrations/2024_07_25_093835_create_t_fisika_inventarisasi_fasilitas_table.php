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
        Schema::create('t_fisika_inventarisasi_fasilitas', function (Blueprint $table) {
            $table->id('id_t_inventarisasi_fasilitas');
            $table->string('foto')->nullable();
            $table->string('nama_fasilitas')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('kondisi_baik')->nullable();
            $table->integer('kondisi_buruk')->nullable();
            $table->string('lokasi_penyimpanan')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_fisika_inventarisasi_fasilitas');
    }
};

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
        Schema::create('t_kimia_inventarisasi_alat', function (Blueprint $table) {
            $table->id('id_t_inventarisasi_alat');
            $table->string('foto')->nullable();
            $table->string('nama_alat')->nullable();
            $table->string('golongan')->default('');
            $table->string('merk')->default('');
            $table->string('ukuran')->default('');
            $table->string('produksi')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('lokasi_penyimpanan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('kondisi_baik')->nullable();
            $table->integer('kondisi_buruk')->nullable();
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
        Schema::dropIfExists('t_kimia_inventarisasi_alat');
    }
};

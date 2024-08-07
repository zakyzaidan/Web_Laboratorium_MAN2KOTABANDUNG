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
        Schema::create('kimia_peminjamanluar_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjamanluar_id');
            $table->unsignedBigInteger('alat_id');
            $table->integer('jumlah');

            // Foreign key constraints
            $table->foreign('peminjamanluar_id')->references('id')->on('kimia_peminjaman_pihak_luar')->onDelete('cascade');
            $table->foreign('alat_id')->references('id_t_inventarisasi_alat')->on('t_kimia_inventarisasi_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kimia_peminjamanluar_alat');
    }
};
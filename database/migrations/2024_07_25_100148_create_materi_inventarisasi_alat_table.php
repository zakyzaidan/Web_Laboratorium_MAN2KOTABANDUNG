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
        Schema::create('materi_inventarisasi_alat', function (Blueprint $table) {
            // $table->id('id');
            // $table->foreignId('id_materi')->constrained('materi')->onDelete('cascade');
            // $table->foreignId('id_t_inventarisasi_alat')->constrained('t_kimia_inventarisasi_alat')->onDelete('cascade');
            // $table->timestamps();

            $table->id('id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('t_kimia_inventarisasi_alat_id');
            $table->timestamps();
            $table->foreign('materi_id')->references('id_materi')->on('materi')->onDelete('cascade');
            $table->foreign('t_kimia_inventarisasi_alat_id')->references('id_t_inventarisasi_alat')->on('t_kimia_inventarisasi_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi_inventarisasi_alat');
    }
};

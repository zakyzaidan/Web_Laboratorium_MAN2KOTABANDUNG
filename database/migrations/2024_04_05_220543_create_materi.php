<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->increments('id_materi');
            $table->string('thubnail_materi', 255)->default('');
            $table->string('modul_pembelajaran_materi', 255)->default('');
            $table->string('judul_materi', 255)->default('');
            $table->longText('isi_materi')->default('');
            $table->mediumText('tujuan_dan_alat_materi')->default('');
            $table->integer('id_admin')->unsigned()->nullable();
            $table->integer('kelas')->unsigned()->nullable();
            $table->mediumText('tambahan_materi')->default('');

            $table->foreign('id_admin')->references('id_admin')->on('t_admin')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};

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
        Schema::create('t_fisika_tenaga_laboratorium', function (Blueprint $table) {
            $table->id('id_tenaga_laboratorium');
            $table->string('foto')->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('golongan')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->string('pendidikan_strata')->nullable();
            $table->string('rancangan_tugas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_fisika_tenaga_laboratorium');
    }
};

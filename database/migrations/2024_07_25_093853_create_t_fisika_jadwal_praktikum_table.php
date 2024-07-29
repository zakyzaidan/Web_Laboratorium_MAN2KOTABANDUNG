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
        Schema::create('t_fisika_jadwal_praktikum', function (Blueprint $table) {
            $table->id('id_t_jadwal_praktikum');
            $table->string('nama')->nullable();
            $table->string('kelas')->nullable();
            $table->string('topik_praktikum')->nullable();
            $table->date('jadwal_praktikum')->nullable();
            $table->string('jadwal_jam_praktikum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_fisika_jadwal_praktikum');
    }
};

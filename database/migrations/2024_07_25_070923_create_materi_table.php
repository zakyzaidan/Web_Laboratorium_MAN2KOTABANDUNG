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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->string('thubnail_materi')->default('');
            $table->string('modul_pembelajaran_materi')->default('');
            $table->string('judul_materi')->default('');
            $table->longText('isi_materi')->nullable();
            $table->mediumText('tujuan_dan_alat_materi')->nullable();
            $table->integer('id_admin')->nullable();
            $table->integer('kelas')->nullable();
            $table->string('pelajaran')->nullable();
            $table->mediumText('tambahan_materi')->nullable();
            $table->string('penulis', 225);
            $table->string('file_materi', 225);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi');
    }
};

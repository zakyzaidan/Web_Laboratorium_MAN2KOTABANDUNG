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
        Schema::create('master_guru', function (Blueprint $table) {
            $table->id(); // Menggunakan bigIncrements secara default
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('kelamin')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('status')->default(0);
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->string('blog')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps(); // Menyediakan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_guru');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biologi_peminjaman_pihak_luar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('status')->nullable();
            $table->date('tanggal_peminjaman')->nullable();
            $table->date('rencana_pengembalian')->nullable();
            $table->date('tanggal_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biologi_peminjaman_pihak_luar');
    }
};

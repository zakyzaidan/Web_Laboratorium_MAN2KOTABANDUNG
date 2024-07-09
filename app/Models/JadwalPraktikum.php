<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktikum extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 't_kimia_jadwal_praktikum';

    // Nama primary key
    protected $primaryKey = 'id_t_jadwal_praktikum';

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama',
        'mata_pelajaran',
        'topik_praktikum',
        'jadwal_praktikum',
        'laboratorium',
        'jadwal_jam_praktikum',
    ];
}

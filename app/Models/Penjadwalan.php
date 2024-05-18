<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = 't_penjadwalan';

    protected $primaryKey = 'id_jadwal_praktikum';

    public $timestamps = false;

    protected $fillable = [
        'kode_mata_pelajaran',
        'mata_pelajaran',
        'nama_lab',
        'hari',
        'jam_masuk',
        'jam_keluar',
        'keterangan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FisikaTenagaLaboratorium extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 't_fisika_tenaga_laboratorium';

    // Nama primary key
    protected $primaryKey = 'id_tenaga_laboratorium';

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'foto',
        'nama',
        'jabatan',
        'golongan',
        'pendidikan_nama',
        'pendidikan_strata',
        'rancangan_tugas',
    ];
}

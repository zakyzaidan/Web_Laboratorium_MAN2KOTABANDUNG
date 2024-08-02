<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiologiJadwalPraktikum extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 't_biologi_jadwal_praktikum';

    // Nama primary key
    protected $primaryKey = 'id_t_jadwal_praktikum';

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama',
        'kelas',
        'materi_id',
        'jadwal_praktikum',
        'jadwal_jam_praktikum',
    ];
    
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function alat()
    {
        return $this->belongsToMany(BiologiInventarisasiAlat::class, 'biologi_jadwal_alat', 'jadwal_praktikum_id', 'alat_id')->withPivot('jumlah');
    }
}

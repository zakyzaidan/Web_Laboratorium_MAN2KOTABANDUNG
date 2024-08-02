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
        return $this->belongsToMany(InventarisasiAlat::class, 'kimia_jadwal_alat', 'jadwal_praktikum_id', 'alat_id')->withPivot('jumlah');
    }

    public function bahan()
    {
        return $this->belongsToMany(InventarisasiBahan::class, 'kimia_jadwal_bahan', 'jadwal_praktikum_id', 'bahan_id')->withPivot('jumlah');
    }
}

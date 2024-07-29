<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FisikaInventarisasiAlat extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 't_fisika_inventarisasi_alat';

    protected $primaryKey = 'id_t_inventarisasi_alat';

    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'foto',
        'nama_alat',
        'golongan',
        'merk',
        'ukuran',
        'produksi',
        'tanggal_masuk',
        'lokasi_penyimpanan',
        'jumlah',
        'satuan',
        'kondisi_baik',
        'kondisi_buruk',
        'keterangan',
    ];

    public function materi()
    {
        return $this->belongsToMany(Materi::class, 'fisika_materi_alat', 't_fisika_inventarisasi_alat_id', 'materi_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisasiBahan extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 't_kimia_inventarisasi_bahan';

    // Nama kolom primary key
    protected $primaryKey = 'id_t_inventarisasi_bahan';

    // Laravel tidak mengasumsikan bahwa tabel memiliki kolom created_at dan updated_at.
    // Dengan menetapkan nilai false ke $timestamps, Anda menonaktifkan perilaku ini
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'foto',
        'nama_bahan',
        'golongan',
        'mr',
        'kemurnian',
        'konsentrasi',
        'wujud',
        'merk',
        'produksi',
        'lokasi_penyimpanan',
        'tanggal_masuk',
        'jumlah',
        'satuan',
        'kondisi_baik',
        'kondisi_buruk',
        'keterangan',
    ];

    public function materi()
    {
        return $this->belongsToMany(Materi::class, 'kimia_materi_bahan', 't_kimia_inventarisasi_bahan_id', 'materi_id');
    }
    
    public function jadwal()
    {
        return $this->belongsToMany(JadwalPraktikum::class, 'kimia_jadwal_bahan', 'bahan_id', 'jadwal_praktikum_id')->withPivot('jumlah');
    }



}

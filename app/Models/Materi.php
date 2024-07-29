<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi'; // Nama tabel di database

    protected $primaryKey = 'id_materi'; // Primary key tabel

    public $timestamps = true; // Laravel secara default mengharapkan kolom created_at dan updated_at. Jika tidak ada, set ke false

    protected $fillable = [ // Kolom-kolom yang dapat diisi
        'thubnail_materi',
        'modul_pembelajaran_materi',
        'judul_materi',
        'isi_materi',
        'tujuan_dan_alat_materi',
        'id_admin',
        'kelas',
        'pelajaran',
        'tambahan_materi',
        'penulis',
        'file_materi'
    ];

    // relasi ke tabel inventarisasi alat
    public function fisika_alat()
    {
        return $this->belongsToMany(FisikaInventarisasiAlat::class, 'fisika_materi_alat', 'materi_id', 't_fisika_inventarisasi_alat_id');
    }

    // relasi ke tabel inventarisasi alat
    public function biologi_alat()
    {
        return $this->belongsToMany(BiologiInventarisasiAlat::class, 'biologi_materi_alat', 'materi_id', 't_biologi_inventarisasi_alat_id');
    }

    // relasi ke tabel inventarisasi alat
    public function kimia_alat()
    {
        return $this->belongsToMany(InventarisasiAlat::class, 'kimia_materi_alat', 'materi_id', 't_kimia_inventarisasi_alat_id');
    }

    // relasi ke tabel inventarisasi alat
    public function kimia_bahan()
    {
        return $this->belongsToMany(InventarisasiBahan::class, 'kimia_materi_bahan', 'materi_id', 't_kimia_inventarisasi_bahan_id');
    }

    // Relasi ke tabel t_admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi'; // Nama tabel di database

    protected $primaryKey = 'id_materi'; // Primary key tabel

    public $timestamps = false; // Laravel secara default mengharapkan kolom created_at dan updated_at. Jika tidak ada, set ke false

    protected $fillable = [ // Kolom-kolom yang dapat diisi
        'thubnail_materi',
        'modul_pembelajaran_materi',
        'judul_materi',
        'isi_materi',
        'tujuan_dan_alat_materi',
        'id_admin',
        'kelas',
        'pelajaran',
        'tambahan_materi'
    ];

    // Relasi ke tabel t_admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}

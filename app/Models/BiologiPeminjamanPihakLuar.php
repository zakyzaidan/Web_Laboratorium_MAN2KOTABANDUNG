<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiologiPeminjamanPihakLuar extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung dengan model
    protected $table = 'biologi_peminjaman_pihak_luar';

    // Nama kolom primary key
    protected $primaryKey = 'id';

    // Laravel tidak mengasumsikan bahwa tabel memiliki kolom created_at dan updated_at.
    // Dengan menetapkan nilai false ke $timestamps, Anda menonaktifkan perilaku ini
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_peminjam',
        'nama_instansi',
        'status',
        'tanggal_peminjaman',
        'rencana_pengembalian',
        'tanggal_pengembalian',
    ];

    public function alat()
    {
        return $this->belongsToMany(BiologiInventarisasiAlat::class, 'biologi_peminjamanluar_alat', 'peminjamanluar_id', 'alat_id')->withPivot('jumlah');
    }
}

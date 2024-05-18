<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuBarang extends Model
{
    use HasFactory;

    protected $table = 't_kartu_barang';

    protected $primaryKey = 'id_kartu_barang';

    public $timestamps = false;

    protected $fillable = [
        'golongan',
        'nomor_induk',
        'nama_barang',
        'merk',
        'ukuran',
        'pabrik',
        'tanggal_masuk',
        'keadaan_masuk',
        'keadaan_keluar',
        'keadaan_persediaan'
    ];
}

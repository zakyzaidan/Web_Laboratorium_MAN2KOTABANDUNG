<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZatLaboratorium extends Model
{
    use HasFactory;

    protected $table = 't_zat_laboratorium';

    protected $primaryKey = 'id_zat_laboratorium';

    public $timestamps = false;

    protected $fillable = [
        'nomor_induk',
        'nama_bahan',
        'golongan_bahan',
        'mr',
        'kemurnian_bahan',
        'konsentrasi_bahan',
        'wujud_bahan',
        'lokasi_penyimpanan_bahan'
    ];
}

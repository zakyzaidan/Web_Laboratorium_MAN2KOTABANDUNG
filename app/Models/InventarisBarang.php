<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBarang extends Model
{
    use HasFactory;

    protected $table = 't_inventaris_barang';

    protected $primaryKey = 'id_invenatris_barang';

    public $timestamps = false;

    protected $fillable = [
        'no_induk',
        'nama_barang',
        'jumlah',
        'satuan',
        'keterangan'
    ];
}

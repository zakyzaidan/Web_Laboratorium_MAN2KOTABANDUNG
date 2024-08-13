<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi';

    // Nama kolom primary key
    protected $primaryKey = 'id';

    protected $fillable = ['jabatan', 'nama', 'foto'];
}

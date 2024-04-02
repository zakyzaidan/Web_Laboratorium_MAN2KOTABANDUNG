<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Siswa extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 't_siswa'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key tabel (default: 'id')

    public $timestamps = false; // Jika tabel Anda tidak memiliki kolom timestamps (created_at dan updated_at)

    protected $fillable = ['username', 'password']; // Kolom yang dapat diisi

    // Jika Anda menggunakan hashing untuk password
    public function getAuthPassword()
    {
        return $this->password;
    }
}

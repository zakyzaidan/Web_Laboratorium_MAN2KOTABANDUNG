<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;


class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'master_guru'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel (default: 'id')

    public $timestamps = false;
    protected $fillable = ['nip', 'nama']; // Kolom yang dapat diisi
    public function getAuthPassword()
    {
        return $this->password;
    }
}

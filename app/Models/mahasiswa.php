<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = ['nama_mahasiswa', 'password', 'jurusan', 'prodi', 'angkatan'];
    public $timestamps = false;
    use HasFactory;
}

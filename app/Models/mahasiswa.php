<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim', 'nama', 'jurusan', 'prodi', 'angkatan', 'user_id'
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getByUserId($userId)
    {
        return static::where('user_id', $userId)->first();
    }
    use HasFactory;
}

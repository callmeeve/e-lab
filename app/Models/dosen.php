<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama_dosen',
        'matakuliah',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $timestamps = false;
    public static function getByUserId($userId)
    {
        return static::where('user_id', $userId)->first();
    }
}

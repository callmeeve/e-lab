<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknisiLab extends Model
{
    protected $table = 'teknisi';
    public $timestamps = false;
    protected $fillable = ['nama_teknisi, user_id,'];
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

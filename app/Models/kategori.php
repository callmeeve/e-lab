<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];
    use HasFactory;
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}

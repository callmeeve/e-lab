<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangLab extends Model
{
    use HasFactory;
    protected $table = 'barang_lab';

    protected $fillable = ['nama_barang', 'image', 'stok', 'id_kategori'];
    public $timestamps = false;
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}

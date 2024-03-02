<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarangDosen extends Model
{
    
    use HasFactory;
    protected $table = 'peminjaman_barang_dosen';

    protected $fillable = [
        'nama_peminjam',
        'prodi',
        'jurusan',
        'barang_id',
        'jumlah',
        'status',
        'kepala_lab_approver_id',
        'teknisi_lab_approver_id',
        'tanggal_pengajuan',
        'tanggal_pengembalian',
    ];

    // Relationship dengan barang
    public function barang()
    {
        return $this->belongsTo(BarangLab::class, 'barang_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarangMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_barang_mahasiswa';
    public $timestamps = false; // Menonaktifkan timestamp

    protected $fillable = [
        'nama_peminjam',
        'prodi',
        'jurusan',
        'barang_id',
        'jumlah',
        'status',
        'dosen_approver_id',
        'teknisi_lab_approver_id',
        'tanggal_pengajuan',
        'tanggal_pengembalian',
        'catatan',
    ];

    // Enum status
    const STATUS_WAITING_DOSEN_APPROVAL = 'menunggu_persetujuan_dosen';
    const STATUS_WAITING_TEKNISI_APPROVAL = 'menunggu_persetujuan_teknisi';
    const STATUS_VALIDATED = 'sudah_tervalidasi';
    const STATUS_REJECTED = 'ditolak';

    // Relationship dengan barang
    public function barang()
    {
        return $this->belongsTo(BarangLab::class, 'barang_id');
    }

    // Method untuk mengubah status ke menunggu persetujuan dosen
    public function setStatusWaitingDosenApproval()
    {
        $this->status = self::STATUS_WAITING_DOSEN_APPROVAL;
        $this->save();
    }

    // Method untuk mengubah status ke menunggu persetujuan teknisi
    public function setStatusWaitingTeknisiApproval()
    {
        $this->status = self::STATUS_WAITING_TEKNISI_APPROVAL;
        $this->save();
    }

    // Method untuk mengubah status ke sudah tervalidasi
    public function setStatusValidated()
    {
        $this->status = self::STATUS_VALIDATED;
        $this->save();
    }

    // Method untuk mengubah status ke ditolak dan menyimpan catatan
    public function reject($catatan)
    {
        $this->status = self::STATUS_REJECTED;
        $this->catatan = $catatan;
        $this->save();
    }
  
}

<?php

namespace App\Http\Controllers;

use App\Models\BarangLab;
use Illuminate\Http\Request;
use App\Models\PeminjamanBarangMahasiswa;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class PeminjamanMahasiswa extends Controller
{
    public function showFormPengajuan()
    {
        $user = Auth::user();
        $listBarang = BarangLab::all();
        $listDosen = Dosen::pluck('nama_dosen', 'id'); // Mengambil daftar nama dosen dari database
        return view('mahasiswa.pengajuan', compact('listDosen', 'listBarang'), [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
    public function storePengajuan(Request $request)
    {
        // Debugging: Cek data yang dikirimkan dari formulir
    
        // Validasi data pengajuan
        $request->validate([
            'nama_peminjam' => 'required',
            'prodi' => 'required',
            'jurusan' => 'required',
            'barang_id' => 'required|exists:barang_lab,id',
            'jumlah' => 'required|integer|min:1',
            'dosen_approver_id' => 'required|exists:dosen,id',
            'tanggal_pengembalian' => 'required|date|after:today',
        ]);
    
        // Proses pengajuan
        $user = Auth::user();
        $mahasiswa = Mahasiswa::getByUserId($user->id);
    
        $pengajuan = new PeminjamanBarangMahasiswa();
        $pengajuan->nama_peminjam = $request->nama_peminjam;
        $pengajuan->prodi = $request->prodi;
        $pengajuan->jurusan = $request->jurusan;
        $pengajuan->barang_id = $request->barang_id;
        $pengajuan->jumlah = $request->jumlah;
        $pengajuan->status = PeminjamanBarangMahasiswa::STATUS_WAITING_DOSEN_APPROVAL;
        $pengajuan->dosen_approver_id = $request->dosen_approver_id;
        $pengajuan->teknisi_lab_approver_id = null;
        $pengajuan->tanggal_pengajuan = now();
        $pengajuan->tanggal_pengembalian = $request->tanggal_pengembalian;
        $pengajuan->id_mahasiswa = $mahasiswa->id;
        $pengajuan->save();
        
        sweetalert()->addSuccess('Pengajuanmu sudah terkirim check di history ya');
        
        return redirect()->route('mahasiswa.dashboard');
    }
    
    
    public function setujuDosen(Request $request, $id)
    {
        // Temukan pengajuan berdasarkan ID
        $pengajuan = PeminjamanBarangMahasiswa::findOrFail($id);
    
        // Ubah status pengajuan menjadi "menunggu_persetujuan_teknisi" dan set ID dosen yang menyetujui
        $pengajuan->setStatusWaitingTeknisiApproval();
        $pengajuan->dosen_approver_id = Auth::user()->id; // Gunakan ID dosen yang sedang login
        $pengajuan->save();
    
        sweetalert()->addSuccess('Pengajuan Berhasil Disetujui');
        
        return redirect()->route('dosen.dashboard');
    }
    
    public function setujuTeknisi(Request $request, $id)
    {
        // Temukan pengajuan berdasarkan ID
        $pengajuan = PeminjamanBarangMahasiswa::findOrFail($id);
    
        // Ubah status pengajuan menjadi "sudah_tervalidasi" dan set ID teknisi yang menyetujui
        $pengajuan->setStatusValidated();
        $pengajuan->teknisi_lab_approver_id = Auth::user()->id; // Gunakan ID teknisi yang sedang login
        $pengajuan->save();
    
        sweetalert()->addSuccess('Pengajuan Berhasil Disetujui');
        
        return redirect()->route('teknisi_lab.dashboard');
    }
    
    public function reject(Request $request, $id)
    {
        // Temukan pengajuan berdasarkan ID
        $pengajuan = PeminjamanBarangMahasiswa::findOrFail($id);
    
        // Ubah status pengajuan menjadi "ditolak" dan simpan catatan penolakan
        $pengajuan->reject($request->catatan);
    
        // Hapus pengajuan dari basis data setelah menolaknya
        $pengajuan->save();
    
        // Kembalikan pengguna ke dashboard yang sesuai
        if ($request->user()->role === 'dosen') {
            sweetalert()->addSuccess('Pengajuan Berhasil Ditolak');
            return redirect()->route('dosen.dashboardPengajuan');
        } elseif ($request->user()->role === 'teknisi') {
            sweetalert()->addSuccess('Pengajuan Berhasil Ditolak');
            return redirect()->route('teknisi_lab.dashboard');
        } else {
            sweetalert()->addSuccess('Pengajuan Berhasil Ditolak');
            return redirect()->route('mahasiswa.dashboard');
        }
    }
    
    public function trackingMahasiswa(Request $request, $id)
    {
        $user = Auth::user();
        $tracking = PeminjamanBarangMahasiswa::findOrFail($id);
    
        // Mendapatkan status pengajuan
        $status = $tracking->status;
        $catatan = $tracking->catatan;
    
        return view('mahasiswa.tracking', [
            'status' => $status,
            'catatan' => $catatan,
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }    
}

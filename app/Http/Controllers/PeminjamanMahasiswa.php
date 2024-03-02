<?php

namespace App\Http\Controllers;

use App\Models\BarangLab;
use Illuminate\Http\Request;
use App\Models\PeminjamanBarangMahasiswa;
use App\Models\Dosen;
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
        // Validasi data pengajuan

        // Proses pengajuan
        $pengajuan = new PeminjamanBarangMahasiswa();
        $pengajuan->nama_peminjam = $request->nama_peminjam;
        $pengajuan->prodi = $request->prodi;
        $pengajuan->jurusan = $request->jurusan;
        $pengajuan->barang_id = $request->barang_id;
        $pengajuan->jumlah = $request->jumlah;
        $pengajuan->status = PeminjamanBarangMahasiswa::STATUS_WAITING_DOSEN_APPROVAL; // Atur status pengajuan
        $pengajuan->dosen_approver_id = $request->dosen_approver_id; // Set ID dosen yang menyetujui
        $pengajuan->teknisi_lab_approver_id = null; // Reset ID teknisi lab
        $pengajuan->tanggal_pengajuan = now(); // Tambahkan tanggal pengajuan
        $pengajuan->tanggal_pengembalian = null; // Reset tanggal pengembalian
        $pengajuan->save();

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
        return redirect()->route('dosen.dashboardPengajuan');
    } elseif ($request->user()->role === 'teknisi') {
        return redirect()->route('teknisi_lab.dashboard');
    } else {
        return redirect()->route('mahasiswa.dashboard');
    }
}


}

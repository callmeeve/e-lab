<?php

namespace App\Http\Controllers;

use App\Models\TeknisiLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeminjamanBarangMahasiswa;
class TeknisiController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke tampilan dashboard
        return view('teknisi_lab.dashboard', [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
    public function dashboardPengajuan()
    {
        // Mendapatkan ID dosen yang sedang login
        $user = Auth::user();

        // Mendapatkan data pengajuan barang yang belum disetujui oleh dosen yang login
        $pengajuanBarang = PeminjamanBarangMahasiswa::where('status', PeminjamanBarangMahasiswa::STATUS_WAITING_TEKNISI_APPROVAL)
            ->get();

        // Mengirim data pengajuan barang ke view dashboard dosen
        return view('teknisi_lab.dashboardPengajuan', [
            'pengajuanBarang' => $pengajuanBarang,
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
}

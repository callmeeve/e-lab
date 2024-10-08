<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\PeminjamanBarangMahasiswa;
class DosenController extends Controller
{
    
    public function dashboard()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mendapatkan data dosen terkait
        $dosen = Dosen::getByUserId($user->id);

        // Jika user terkait adalah seorang dosen
        if ($dosen) {
            // Menghitung jumlah pengajuan masuk
            $countPengajuanMasuk = PeminjamanBarangMahasiswa::where('dosen_approver_id', $dosen->id)->count();

            // Menghitung jumlah pengajuan yang perlu disetujui
            $countPengajuanPerluDisetujui = PeminjamanBarangMahasiswa::where('dosen_approver_id', $dosen->id)
                ->where('status', PeminjamanBarangMahasiswa::STATUS_WAITING_DOSEN_APPROVAL)
                ->count();

            // Mengirim data pengguna ke tampilan dashboard
            return view('dosen.dashboard', [
                'jumlah_pengajuan_masuk' => $countPengajuanMasuk,
                'jumlah_pengajuan_perlu_disetujui' => $countPengajuanPerluDisetujui,
                'nama' => $user->username,
                'email' => $user->email,
            ]);
        } else {
            sweetalert()->addWarning('Isi data dirimu untuk Profile ya!');
            return redirect()->route('dosen.register');
        }
    }

    public function ShowFormProfile()
    {
        $user = Auth::user();
        $dosen = Dosen::getByUserId($user->id);

        
        if ($dosen) {
            // Jika data dosen sudah ada, tampilkan form update
            return view('dosen.profile', compact('dosen'), [
                'dosen' => $dosen,
                'nama' => $user->username,
                'email' => $user->email,
            ]
        );
        } else {
            // Jika tidak ada, kirimkan formulir register
            return view('dosen.profile', [
                'dosen' => $dosen,
                'nama' => $user->username,
                'email' => $user->email,
            ]);
        }
    }

    
    public function registerProfile(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nidn' => 'required|unique:dosen',
            'nama_dosen' => 'required',
            'matakuliah' => 'required',
        ]);

        // Mengambil ID pengguna yang sedang login
        $user_id = Auth::id();

        // Buat data dosen baru
        $dosen = new Dosen();
        $dosen->nidn = $request->nidn;
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->matakuliah = $request->matakuliah;
        $dosen->user_id = $user_id;
        $dosen->save();

        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('dosen.dashboard');
    }
    public function updateProfile(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nidn' => 'required',
            'nama_dosen' => 'required',
            'matakuliah' => 'required',
        ]);

        // Dapatkan dosen berdasarkan user yang sedang login
        $dosen = Auth::user()->dosen;

        // Perbarui informasi dosen
        $dosen->update([
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'matakuliah' => $request->matakuliah,
        ]);

        // Redirect to dashboard or other page
        return redirect()->route('dashboard');
    }
    public function dashboardPengajuan()
    {
        // Mendapatkan ID dosen yang sedang login
        $user = Auth::user();
        $dosen = Dosen::getByUserId($user->id);    
        
        // Mendapatkan data pengajuan barang yang telah disetujui oleh dosen yang login
        $pengajuanBarang = PeminjamanBarangMahasiswa::where('dosen_approver_id', $dosen->id)    // Mengabaikan pengajuan yang ditolak
        ->get();
        // Mengirim data pengajuan barang ke view dashboard dosen
        return view('dosen.dashboardPengajuan', ['pengajuanBarang' => $pengajuanBarang], [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PeminjamanBarangMahasiswa;
use RealRashid\SweetAlert\Facades\Alert;
class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke tampilan dashboard
        return view('mahasiswa.dashboard', [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function ShowFormProfile()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::getByUserId($user->id);
        
        if ($mahasiswa) {
            // Jika data dosen sudah ada, tampilkan form update
            return view('mahasiswa.profile', compact('mahasiswa'), [
                'mahasiswa' => $mahasiswa,
                'nama' => $user->username,
                'email' => $user->email,
            ]
        );
        } else {
            // Jika tidak ada, kirimkan formulir register
            return view('mahasiswa.profile', [
                'nama' => $user->username,
                'email' => $user->email,
            ]);
        }
    }
    
    public function registerProfile(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama_mahasiswa' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'angkatan' => 'required',
        ]);

        // Mengambil ID pengguna yang sedang login
        $user_id = Auth::id();

        // Buat mahasiswa baru
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->user_id = $user_id;
        $mahasiswa->save();
        Alert::success('Success', 'Registrasimu Berhasil')->showConfirmButton('OK');
        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('mahasiswa.dashboard');
    }

    public function historyMahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::getByUserId($user->id);
        
        // Pastikan mahasiswa ditemukan
        if (!$mahasiswa) {
            Alert::success('Error', 'Namamu tidak ditemukan')->showConfirmButton('OK');
        }
    
        // Mendapatkan data pengajuan barang yang telah disetujui oleh dosen yang login
        $pengajuanBarang = PeminjamanBarangMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->get();
        return view('mahasiswa.history', compact('pengajuanBarang'),[
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
}

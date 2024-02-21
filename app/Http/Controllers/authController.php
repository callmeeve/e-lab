<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\teknisi;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    public function registerMahasiswa(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nim' => 'unique:mahasiswa|regex:/^[0-9]{8}$/',
                'nama_mahasiswa' => 'required|string',
                'jurusan' => 'required|string',
                'prodi' => 'required|string',
                'angkatan' => 'required|string',
                'password' => 'required|string',
            ], [
                'nim.regex' => 'NIM harus terdiri dari 8 digit angka'
            ]);
    
            // Buat mahasiswa baru
            $mahasiswa = Mahasiswa::create([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'jurusan' => $request->jurusan,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
                'password' => bcrypt($request->password), // Encrypt password
            ]);
    
            // Respon berhasil
            return response()->json(['message' => 'Registrasi mahasiswa berhasil', 'mahasiswa' => $mahasiswa], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function registerDosen(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nidn' => 'unique:mahasiswa|regex:/^[0-9]{8}$/',
                'nama_dosen' => 'required|string',
                'password' => 'required|string',
            ], [
                'nidn.regex' => 'NIM harus terdiri dari 8 digit angka'
            ]);
    
            // Buat mahasiswa baru
            $dosen = dosen::create([
                'nidn' => $request->nidn,
                'nama_dosen' => $request->nama_dosen,
                'password' => bcrypt($request->password), // Encrypt password
            ]);
    
            // Respon berhasil
            return response()->json(['message' => 'Registrasi mahasiswa berhasil', 'mahasiswa' => $dosen], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function registerTeknisi(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id_teknisi' => 'unique:mahasiswa|regex:/^[0-9]{8}$/',
                'nama_teknisi' => 'required|string',
                'password' => 'required|string',
            ], [
                'id_teknisi.regex' => 'NIM harus terdiri dari 8 digit angka'
            ]);
    
            // Buat mahasiswa baru
            $teknisi = teknisi::create([
                'id_teknisi' => $request->nidn,
                'nama_teknisi' => $request->nama_teknisi,
                'password' => bcrypt($request->password), // Encrypt password
            ]);
    
            // Respon berhasil
            return response()->json(['message' => 'Registrasi mahasiswa berhasil', 'mahasiswa' => $teknisi], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    
}

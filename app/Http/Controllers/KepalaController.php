<?php

namespace App\Http\Controllers;

use App\Models\KepalaLaboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepalaController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke tampilan dashboard
        return view('kepala_lab.dashboard', [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }
    public function ShowFormProfile()
    {
        $user = Auth::user();
        $dosen = KepalaLaboratorium::getByUserId($user->id);    
        
        if ($dosen) {
            // Jika data dosen sudah ada, tampilkan form update
            return view('kepala_lab.profile', compact('dosen'), [
                'dosen' => $dosen,
                'nama' => $user->username,
                'email' => $user->email,
            ]
        );
        } else {
            // Jika tidak ada, kirimkan formulir register
            return view('kepala_lab.profile', [
                'dosen' => $dosen,
                'id_dosen' => $dosen->user_id,
                'nama' => $user->username,
                'email' => $user->email,
            ]);
        }
    }
}

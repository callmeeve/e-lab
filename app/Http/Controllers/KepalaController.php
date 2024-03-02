<?php

namespace App\Http\Controllers;

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
}

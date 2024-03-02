<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerMahasiswa(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:user',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'mahasiswa';
        $user->save();

        return redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            if (Auth::user()->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            } elseif (Auth::user()->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            } elseif (Auth::user()->role === 'teknisi_lab') {
                return redirect()->route('teknisi_lab.dashboard');
            } elseif (Auth::user()->role === 'kepala_lab') {
                return redirect()->route('kepala_lab.dashboard');
            } 
            else {
                return redirect()->route('dashboard');
            }
        }
        return redirect()->back()->withErrors(['Email dan password tidak cocok!'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->withSuccess('Logout berhasil!');
    }
}

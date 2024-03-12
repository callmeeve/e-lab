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
            'nim' => 'required|unique:user',
            'username' => 'required|unique:user',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
        ]);
    
        $user = new User();
        $user->nim = $request->nim;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'mahasiswa';
        $user->save();
        sweetalert()->addSuccess('Registrasi berhasil! Silahkan login');
        return redirect()->route('login');
    }
    

    public function login()
    {

        return view('login');
    }

    public function loginProcess(Request $request)
    {
        // Validator untuk email dan password
        $validator = Validator::make($request->all(), [
            'credential' => 'required', // Form field for email or NIM
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            sweetalert()->addWarning('silahkan masukan data dengan benar');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Cek apakah credential yang diberikan adalah email atau NIM
        $credentialType = filter_var($request->credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
    
        // Cari pengguna berdasarkan credential yang sesuai
        $user = User::where($credentialType, $request->credential)->first();
    
        // Jika pengguna tidak ditemukan
        if (!$user) {
            sweetalert()->addWarning('tidak ada');
            return back()->withErrors([
                'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ]);
        }
    
        // Coba melakukan autentikasi dengan credential yang diberikan
        $credentials = [
            $credentialType => $request->credential,
            'password' => $request->password
        ];
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Redirect sesuai peran pengguna
            switch ($user->role) {
                case 'mahasiswa':
                    sweetalert()->addSuccess('Login Berhasil!');
                    return redirect()->route('mahasiswa.dashboard');
                case 'dosen':
                    sweetalert()->addSuccess('Login Berhasil!');
                    return redirect()->route('dosen.dashboard');
                case 'teknisi_lab':
                    sweetalert()->addSuccess('Login Berhasil!');
                    return redirect()->route('teknisi_lab.dashboard');
                case 'kepala_lab':
                    sweetalert()->addSuccess('Login Berhasil!');
                    return redirect()->route('kepala_lab.dashboard');
                default:
                    return redirect()->intended('dashboard');
            }
        }
    
        return back()->withErrors([
            sweetalert()->addWarning('tidak ada'),
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }
    
   
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        sweetalert()->addSuccess('Logout Berhasil!');
        return redirect('/login');
    }
}

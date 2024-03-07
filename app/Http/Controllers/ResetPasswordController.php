<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('resetPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $token = sha1($email . time());

        Mail::send('linkReset', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });

        return redirect()->route('login')->with('success', 'Link reset password telah dikirim ke email Anda');
    }
    public function resetPasswordForm($token)
    {
        return view('updatePassword', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        
        

        return redirect()->route('login')->with('success', 'Password Anda berhasil direset');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak terdaftar.');
        }

        // Generate token and set expiry time
        $token = Str::random(60); // Menggunakan Str::random() untuk menghasilkan token acak yang panjangnya 60 karakter
        $expiry = Carbon::now()->addHours(1);

        // Save token and expiry time to user
        $user->reset_token = $token;
        $user->reset_token_expiry = $expiry;
        $user->save();

        // Send email with reset link
        Mail::send('linkReset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('login')->with('success', 'Link reset password telah dikirim ke email Anda');
    }

    public function resetPasswordForm($token)
    {
        $user = User::where('reset_token', $token)->first();


        return view('updatePassword', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('reset_token', $request->token)
                    ->where('reset_token_expiry', '>=', Carbon::now())
                    ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Token reset password tidak valid atau telah kadaluarsa.');
        }

        // Update password and clear token fields
        $user->password = bcrypt($request->password);
        $user->reset_token = null;
        $user->reset_token_expiry = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password Anda berhasil direset');
    }
}

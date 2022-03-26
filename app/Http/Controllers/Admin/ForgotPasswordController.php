<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.admin.forget_password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => now()->toDateTimeString(),
        ]);

        Mail::send('auth.admin.forget_password_link', compact('token'), function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Reset link sudah terkirim!');
    }

    public function showResetPasswordForm($token) {
        return view('auth.admin.forget_password_form', compact('token'));
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|same:repeat_password',
            'repeat_password' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::query()->where('email', $updatePassword->email)
                             ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['token'=> $request->token])->delete();

        return redirect(route('login'))->with('message', 'Password berhasil di ubah!');
    }
}

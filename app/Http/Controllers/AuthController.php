<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Mail\ResetPassword;
use App\Models\Tiket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Svg\Tag\Rect;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }


    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => true
        ];

        if (auth()->attempt($credentials)) {
            if ($request->tiket_id) {
                $tiket = Tiket::find($request->tiket_id);

                return redirect()->route('landing-page.acara.show', $tiket->jenisTiket->acara->slug);
            } else {
                return redirect()->route('landing-page.index');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function getRegister()
    {
        return view('auth.register');
    }
    public function reset()
    {
        return view('auth.reset');
    }
    public function reset_password_last($token, $email)
    {
        if (!$token) {
            return abort(404);
        }
        return view('auth.reset_password', compact('email'));
    }
    public function reset_password(Request $request)
    {
        $cekEmail = User::where('email', $request->email)->first();
        if (!$cekEmail) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
        $verify_token = Str::random(25);

        $payload = [
            'nama' => $request->nama,
            'email' => $request->email,
            'verify_token' => $verify_token
        ];
        Mail::to($request->email)->send(new ResetPassword($payload));
        return redirect()->back()->with('success', 'Link reset password telah dikirim ke email');
    }
    public function reset_password_save(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('success', 'Password berhasil di reset');
    }
    public function doRegister(UserRequest $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/'
        ], [
            "nama.regex" => "Don't put symbol"
        ]);

        $verify_token = Str::random(25);

        $payload = [
            'nama' => $request->nama,
            'verify_token' => $verify_token
        ];

        DB::beginTransaction();

        try {
            Mail::to($request->email)->send(new VerifyEmail($payload));

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'verify_email_token' => $verify_token,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'is_active' => false
            ]);
            // Auth::login($user);

            DB::commit();
            // return redirect()->route('landing-page.index')->with('success', 'Registrasi berhasil. Anda telah masuk.');

            return redirect()->back()->with('success', 'Silahkan periksa email anda');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Proses registrasi gagal');
        }
    }

    public function doLogout()
    {
        auth()->logout();

        return redirect()->route('landing-page.index');
    }

    public function doVerifikasi($token)
    {
        if (!$token) {
            abort(404);
        }

        $user = User::where('verify_email_token', $token)->firstOrFail();

        $user->update([
            'email_verified_at' => date('Y-m-d H:i:s'),
            'verify_email_token' => null,
            'is_active' => true
        ]);
        return redirect()->route('login')->with('success', 'Email berhasil di verifikasi, silahkan masuk');
    }
}

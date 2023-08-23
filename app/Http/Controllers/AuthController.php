<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

                return redirect()->route('landing-page.acara.detail_tiket', [$tiket->jenisTiket->acara->slug, $tiket->jenisTiket->id]);
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

    public function doRegister(UserRequest $request)
    {
        $verify_token = Str::random(25);

        $payload = [
            'nama' => $request->nama,
            'verify_token' => $verify_token
        ];

        DB::beginTransaction();

        try {
            // Mail::to($request->email)->send(new VerifyEmail($payload));

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                // 'verify_email_token' => $verify_token

                'email_verified_at' => date('Y-m-d H:i:s'),
                'verify_email_token' => null,
                'is_active' => true
            ]);

            DB::commit();
            return redirect()->route('landing-page.index')->with('success', 'Registrasi berhasil. Anda telah masuk.');

            // return redirect()->back()->with('success', 'Silahkan periksa email anda');
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

        $user = User::where('verify_email_token', '=', $token)->firstOrFail();

        $user->update([
            'email_verified_at' => date('Y-m-d H:i:s'),
            'verify_email_token' => null,
            'is_active' => true
        ]);

        return redirect()->route('login')->with('success', 'Email berhasil di verifikasi, silahkan masuk');
    }
}

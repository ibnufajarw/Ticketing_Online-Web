<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update_password(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->with("error", "Password lama anda salah.");
        }
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed', // Tambahkan validasi konfirmasi
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru salah', // Pesan untuk konfirmasi yang salah
        ]);

        // Menggunakan Hash::make() untuk mengenkripsi password baru
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return redirect()->route('profile.index')->with('success', 'Password successfully updated');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Kampus;
use App\Models\Kategori;
use App\Models\MetodePembayaran;
use App\Models\Slider;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        $slider = Slider::get();
        $kampus = Kampus::get();
        $acara = Acara::with(['lokasi', 'jenisTiketGratis', 'jenisTiketBerbayar.tiketBerbayarStartFrom'])->orderBy('waktu_mulai', 'asc')
            ->when(request()->q, function ($query) {
                $query->where('judul', 'like', '%' . request()->q . '%');
            })
            ->when(request()->kategori_id, function ($query) {
                $query->where('kategori_id', 'like', '%' . request()->kategori_id . '%');
            })
            ->when(request()->kampus_id, function ($query) {
                $query->where('kampus_id', 'like', '%' . request()->kampus_id . '%');
            })
            ->where('status', 'published')
            ->get();

        return view('landing-page.index', compact('kategori', 'kampus', 'acara', 'slider'));
    }
    public function midtrans($transaksiCode)
    {
        $transaksi = Transaksi::where('kode_transaksi', $transaksiCode)->first();
        $rekenings = MetodePembayaran::where('jenis', 'bank')->get();
        $snapToken = $this->snapToken($transaksi);
        return view('landing-page.midtrans', compact('rekenings', 'transaksi', 'snapToken'));
    }
    public function successPage()
    {
        return view('landing-page.success_page');
    }
}

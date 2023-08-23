<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\JenisTiket;
use App\Models\Tiket;
use Illuminate\Http\Request;

class JenisTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Acara $acara)
    {
        if ($acara->user_id != auth()->user()->id) {
            return abort(404);
        }
        $tiket_gratis = JenisTiket::withCount('tiket')->where('acara_id', $acara->id)->where('is_free', '=', true)->first();
        $tiket_berbayar = JenisTiket::withCount('tiket')->where('acara_id', $acara->id)->where('is_free', '=', false)->first();

        $jenis_tiket = ($request->jenis ? $request->jenis : 'gratis');
        if ($jenis_tiket == 'gratis') {
            $tikets = Tiket::where('jenis_tiket_id', $tiket_gratis ? $tiket_gratis->id : '0')->count();
        } else if ($jenis_tiket != 'gratis') {
            $tikets = Tiket::where('jenis_tiket_id', $tiket_berbayar ? $tiket_berbayar->id : '0')->count();
        }
        return view('dashboard.acara.tiket.index', compact('acara', 'tiket_gratis', 'tiket_berbayar', 'jenis_tiket', 'tikets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Acara $acara)
    {
        $request->merge(['jenis' => $request->is_free ? 'gratis' : 'berbayar']);

        JenisTiket::create([
            'acara_id' => $acara->id,
            'is_free' => $request->is_free,
            'kuota' => $request->kuota,
            'nama_paket' => $request->jenis_tiket,
            // 'keuntungan' => $request->keuntungan
        ]);

        $jenis = $request->jenis; // Ambil nilai 'jenis' dari request

        return redirect()->route('dashboard.jenis-tiket.index', [$acara->id, 'jenis' => $jenis])->with('success', 'Data berhasil disimpan');
    }

    public function delete(Request $request, Acara $acara)
    {
        if ($request->jenis == 'gratis') {
            JenisTiket::where('acara_id', $acara->id)->where('is_free', '1')->delete();
        } else {
            JenisTiket::where('acara_id', $acara->id)->where('is_free', '0')->delete();
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Tiket;
use App\Models\JenisTiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function datatableJson(Request $request, Acara $acara)
    {
        $jenis_tiket = ($request->jenis_tiket == 'gratis' ? 1 : 0);

        $jenis_tiket_id = JenisTiket::where('acara_id', '=', $acara->id)
            ->where('is_free', '=', $jenis_tiket)
            ->first()
            ->id ?? 0;

        $data = Tiket::where('jenis_tiket_id', '=', $jenis_tiket_id);

        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                return '
            <form action="' . route('dashboard.tiket.destroy', $data->id) . '" method="POST" style="display: inline">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</button>
            </form>
        ';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Acara $acara)
    {
        // get jenis tiket
        $is_free = ($request->jenis_tiket == 'gratis' ? 1 : 0);

        $jenis_tiket = JenisTiket::where('is_free', '=', $is_free)
            ->where('acara_id', '=', $acara->id)
            ->first();

        Tiket::create([
            'jenis_tiket_id' => $jenis_tiket->id,
            'kode' => $acara->id . $jenis_tiket->id . Str::random(6),
            'tier' => $request->tier,
            'kursi' => $request->kursi,
            'harga' => ($request->harga ? $request->harga : 0)
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
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
    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}

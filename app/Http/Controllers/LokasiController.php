<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Requests\LokasiRequest;
use Yajra\DataTables\Facades\DataTables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.lokasi.index');
    }

    public function datatableJson()
    {
        $data = Lokasi::query();

        return DataTables::of($data)
                            ->addColumn('aksi', function($data) {
                                return '
                                    <a href="'.route('dashboard.lokasi.edit', $data->id).'" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-id="'.$data->id.'">Hapus</button>
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
        return view('dashboard.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LokasiRequest $request)
    {
        Lokasi::create($request->only('nama'));

        return redirect()->route('dashboard.lokasi.index')->with('success', 'Data berhasil disimpan');
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
    public function edit(Lokasi $lokasi)
    {
        return view('dashboard.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LokasiRequest $request, Lokasi $lokasi)
    {
        $lokasi->update($request->only('nama'));

        return redirect()->route('dashboard.lokasi.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}

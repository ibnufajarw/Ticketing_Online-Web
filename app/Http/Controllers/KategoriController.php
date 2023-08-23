<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\KategoriRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function landingPageIndex()
    {
        return view('landing-page.kategori.index');
    }

    public function datatableJson()
    {
        $data = Kategori::query();

        return DataTables::of($data)
            ->editColumn('thumbnail', function ($data) {
                $thumbnail = $data->thumbnail ? Storage::disk('local')->url($data->thumbnail) : asset('img/no_image.jpeg');

                return '<img src="' . $thumbnail . '" width="100">';
            })
            ->addColumn('aksi', function ($data) {
                return '
                                    <a href="' . route('dashboard.kategori.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-id="' . $data->id . '">Hapus</button>
                                ';
            })
            ->rawColumns(['aksi', 'thumbnail'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        if ($request->thumbnail) {
            $filename = Storage::disk('public')->putFile('image/kategori/', $request->thumbnail);
        }
        Kategori::create([
            'nama' => $request->nama,
            'thumbnail' => $filename ?? null
        ]);

        return redirect()->route('dashboard.kategori.index')->with('success', 'Data berhasil disimpan');
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
    public function edit(Kategori $kategori)
    {
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        if ($request->thumbnail) {
            $filename = Storage::disk('public')->putFile('image/kategori/', $request->thumbnail);
        }
        $kategori->update([
            'nama' => $request->nama,
            'thumbnail' => $filename ?? $kategori->thumbnail
        ]);

        return redirect()->route('dashboard.kategori.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}

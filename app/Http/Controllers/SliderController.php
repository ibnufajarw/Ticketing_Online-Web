<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\KategoriRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{

    public function datatableJson()
    {
        $data = Slider::query();

        return DataTables::of($data)
            ->editColumn('thumbnail', function ($data) {
                $thumbnail = $data->thumbnail ? Storage::disk('local')->url($data->thumbnail) : asset('img/no_image.jpeg');

                return '<img src="' . $thumbnail . '" width="100">';
            })
            ->addColumn('aksi', function ($data) {
                return '
                                    <a href="' . route('dashboard.slider.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>
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
        return view('dashboard.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->thumbnail) {
            $filename = Storage::disk('public')->putFile('image/slider/', $request->thumbnail);
        }
        Slider::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $filename ?? null
        ]);

        return redirect()->route('dashboard.slider.index')->with('success', 'Data berhasil disimpan');
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
    public function edit(Slider $slider)
    {
        return view('dashboard.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        if ($request->thumbnail) {
            $filename = Storage::disk('public')->putFile('image/slider/', $request->thumbnail);
        }
        $slider->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $filename ?? $slider->thumbnail
        ]);

        return redirect()->route('dashboard.slider.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $kategori)
    {
        $kategori->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}

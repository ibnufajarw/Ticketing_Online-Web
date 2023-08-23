<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\CustomHelpers;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MetodePembayaranRequest;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.metode-pembayaran.index');
    }

    public function datatableJson()
    {
        $data = MetodePembayaran::query();

        return DataTables::of($data)
                            ->filterColumn('metode_pembayaran', function($query, $keyword) {
                                $query->where('nama', 'like', '%'.$keyword.'%')
                                        ->orWhere('jenis', 'like', '%'.$keyword.'%');
                            })
                            ->editColumn('logo', function($data) {
                                $logo = ($data->logo ?: asset('img/no_image.jpeg'));

                                return '<img src="'.$logo.'" width="100">';
                            })
                            ->addColumn('metode_pembayaran', function($data) {
                                $jenis = ($data->jenis === 'dompet_digital' ? "<span class='badge badge-primary'>Dompet Digital</span>" : "<span class='badge badge-success'>Bank</span>");

                                return $data->nama.' '.$jenis;
                            })
                            ->addColumn('aksi', function($data) {
                                return '
                                    <a href="'.route('dashboard.metode-pembayaran.edit', $data->id).'" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-id="'.$data->id.'">Hapus</button>
                                ';
                            })
                            ->rawColumns(['aksi', 'logo', 'metode_pembayaran'])
                            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.metode-pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetodePembayaranRequest $request)
    {
        DB::beginTransaction();

        try {
            $logo = $request->logo ? CustomHelpers::uploadImage($request->logo, 'logo') : null;

            MetodePembayaran::create([
                'nama' => $request->nama,
                'logo' => $logo,
                'jenis' => $request->jenis,
                'no_rekening' => $request->no_rekening,
                'atas_nama' => $request->atas_nama
            ]);

            DB::commit();

            return redirect()->route('dashboard.metode-pembayaran.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollback();

            // delete file
            if($logo) {
                CustomHelpers::deleteImage($logo, 'logo');
            }

            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
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
    public function edit(MetodePembayaran $metode_pembayaran)
    {
        return view('dashboard.metode-pembayaran.edit', compact('metode_pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetodePembayaranRequest $request, MetodePembayaran $metode_pembayaran)
    {
        DB::beginTransaction();

        try {
            if($request->logo) {
                CustomHelpers::deleteImage($metode_pembayaran->logo, 'logo');
            }

            $logo = $request->logo ? CustomHelpers::uploadImage($request->logo, 'logo') : $metode_pembayaran->logo;

            $metode_pembayaran->update([
                'nama' => $request->nama,
                'logo' => $logo,
                'jenis' => $request->jenis,
                'no_rekening' => $request->no_rekening,
                'atas_nama' => $request->atas_nama
            ]);

            DB::commit();

            return redirect()->route('dashboard.metode-pembayaran.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollback();

            // delete file
            if($logo) {
                CustomHelpers::deleteImage($logo, 'logo');
            }

            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodePembayaran $metode_pembayaran)
    {
        $metode_pembayaran->delete();

        CustomHelpers::deleteImage($metode_pembayaran->logo, 'logo');

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}

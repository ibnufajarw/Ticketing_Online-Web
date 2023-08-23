<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Acara;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\CustomHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AcaraRequest;
use App\Models\JenisTiket;
use App\Models\Keuntungan;
use App\Models\Tiket;
use App\Models\Transaksi;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        updateToKadaluarsa();
        return view('dashboard.acara.index');
    }

    public function datatableJson(Request $request)
    {
        $data = Acara::query();
        $data->when(auth()->user()->role == 'user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });
        return DataTables::of($data)
            ->editColumn('thumbnail', function ($data) {
                $thumbnail = $data->thumbnail ? Storage::disk('local')->url($data->thumbnail) : asset('img/no_image.jpeg');

                return '<img src="' . $thumbnail . '" width="100">';
            })
            ->addColumn('kuota', function ($data) {
                return getKuota($data);
            })
            ->editColumn('waktu_mulai', function ($data) {
                $waktu_mulai = $data->waktu_mulai->format('d/m/Y H:i');
                $estimasi_durasi = $data->durasi_menit_estimasi . ' menit';

                return $waktu_mulai . ' <span class="badge badge-primary">' . $estimasi_durasi . '</span>';
            })
            ->addColumn('status', function ($data) {
                $status =  $data->status == 'pending' ? '<span class="badge badge-secondary">Draft</span>' : '<span class="badge badge-success">Published</span>';

                return $status;
            })
            ->addColumn('aksi', function ($data) use ($request) {
                $jenisTiket = JenisTiket::where('acara_id', $data->id)->first();
                if ($jenisTiket) {
                    $request->merge(['jenis' => $jenisTiket->is_free ? 'gratis' : 'berbayar']);
                    $jenis = $request->jenis; // Ambil nilai 'jenis' dari request
                    return '
                        <a href="' . route('dashboard.acara.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('dashboard.acara.edit', $data->id) . '" class="btn btn-sm btn-info">Detail</a>
                        <a href="' . route('dashboard.jenis-tiket.index', [$data->id, 'jenis' => $jenis]) . '" class="btn btn-sm btn-success">Kelola Tiket</a>
                    ';
                } else {
                    return '
                        <a href="' . route('dashboard.acara.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('dashboard.acara.edit', $data->id) . '" class="btn btn-sm btn-info">Detail</a>
                        <a href="' . route('dashboard.jenis-tiket.index', $data->id) . '" class="btn btn-sm btn-success">Kelola Tiket</a>
                    ';
                }
            })
            ->rawColumns(['aksi', 'thumbnail', 'waktu_mulai', 'status'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = DB::table('kategori')->orderBy('nama')->get();
        $lokasi = DB::table('lokasi')->orderBy('nama')->get();
        $kampus = DB::table('kampus')->orderBy('nama')->get();

        return view('dashboard.acara.create', compact('kategori', 'lokasi', 'kampus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcaraRequest $request)
    {
        $slug = Str::slug($request->judul);

        DB::beginTransaction();

        try {
            // cek apakah slug sudah ada
            $count_slug = DB::table('acara')->select('id')->where('slug', '=', $slug)->count();

            if ($count_slug) {
                $slug = $slug . '-' . ($count_slug + 1);
            }

            if ($request->thumbnail) {
                $thumbnail = Storage::disk('public')->putFile('image/acara/', $request->thumbnail);
            }
            if ($request->foto_stage) {
                $foto_stage = Storage::disk('public')->putFile('image/acara/', $request->foto_stage);
            }

            Acara::create([
                'kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,
                'kampus_id' => ($request->kampus_id ?: null),
                'judul' => $request->judul,
                'thumbnail' => $thumbnail ?? null,
                'deskripsi' => $request->deskripsi,
                'waktu_mulai' => $request->waktu_mulai,
                'durasi_menit_estimasi' => $request->durasi_menit_estimasi,
                'slug' => $slug,
                'kuota' => $request->kuota,
                'dress_code' => $request->dress_code,
                'status' => 'draft',
                'peraturan' => $request->peraturan,
                'foto_stage' => $foto_stage ?? null,
                'alamat' => $request->alamat,
                // 'latitude' => $request->latitude,
                // 'longitude' => $request->longitude,
            ]);
            // dd('berhasil');

            DB::commit();

            return redirect()->route('dashboard.acara.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            // dd($e->getMessage());
            DB::rollback();
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
    public function edit(Acara $acara)
    {
        $kategori = DB::table('kategori')->orderBy('nama')->get();
        $lokasi = DB::table('lokasi')->orderBy('nama')->get();
        $kampus = DB::table('kampus')->orderBy('nama')->get();
        if ($acara->user_id != auth()->user()->id) {
            return abort(404);
        }
        return view('dashboard.acara.edit', compact('kategori', 'lokasi', 'acara', 'kampus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcaraRequest $request, Acara $acara)
    {
        $slug = Str::slug($request->judul);

        DB::beginTransaction();

        try {
            // cek apakah slug sudah ada
            $count_slug = DB::table('acara')
                ->select('id')
                ->where('slug', '=', $slug)
                ->where('id', '!=', $acara->id)
                ->count();

            if ($count_slug) {
                $slug = $slug . '-' . ($count_slug + 1);
            }

            $thumbnail = $acara->thumbnail;
            $foto_stage = $acara->foto_stage;
            if ($request->thumbnail) {
                $thumbnail = Storage::disk('public')->putFile('image/acara/', $request->thumbnail);
            }
            if ($request->foto_stage) {
                $foto_stage = Storage::disk('public')->putFile('image/acara/', $request->foto_stage);
            }

            $acara->update([
                'kategori_id' => $request->kategori_id,
                'kampus_id' => ($request->kampus_id ?: null),
                'judul' => $request->judul,
                'thumbnail' => $thumbnail,
                'deskripsi' => $request->deskripsi,
                'waktu_mulai' => $request->waktu_mulai,
                'durasi_menit_estimasi' => $request->durasi_menit_estimasi,
                'slug' => $slug,
                'kuota' => $request->kuota,
                'dress_code' => $request->dress_code,
                'peraturan' => $request->peraturan,
                'foto_stage' => $foto_stage,
                'alamat' => $request->alamat,
                // 'latitude' => $request->latitude,
                // 'longitude' => $request->longitude,
            ]);

            DB::commit();

            return redirect()->route('dashboard.acara.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            // dd($e->getMessage());
            DB::rollback();

            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acara $acara)
    {
        $acara->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }

    public function landingPageShow($slug)
    {
        $acara = Acara::with('lokasi')->where('slug', '=', $slug)->firstOrFail();
        $tiket_gratis = JenisTiket::where('acara_id', $acara->id)->where('is_free', '=', true)->first();
        $tiket_berbayar = JenisTiket::where('acara_id', $acara->id)->where('is_free', '=', false)->first();
        $tiketGratis = Tiket::where('jenis_tiket_id', $tiket_gratis ? $tiket_gratis->id : '0')->get();
        $tiketBerbayar = Tiket::where('jenis_tiket_id', $tiket_berbayar ? $tiket_berbayar->id : '0')->get();
        return view('landing-page.acara.show', compact('acara', 'tiketGratis', 'tiketBerbayar'));
    }
    public function detailTiket($slug, $jenisTiketId)
    {
        updateToKadaluarsa();
        $acara = Acara::where('slug', '=', $slug)->firstOrFail();
        if ($acara->user_id != auth()->user()->id) {
            return abort(404);
        }
        $jenisTiket = JenisTiket::find($jenisTiketId);
        return view('landing-page.acara.jenis_tiket', compact('acara', 'jenisTiket'));
    }
    public function getKeuntunganTiket(Request $request)
    {
        $data = Keuntungan::where('tiket_id', $request->tiket_id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Keuntungan Tiket',
            'data' => $data
        ]);
    }
    public function beliTiket(Request $request)
    {
        $tiket = Tiket::find($request->tiket_id);
        $transactionNumber = Transaksi::count() + 1;
        $transactionNumber = str_pad($transactionNumber, 3, '0', STR_PAD_LEFT);
        $randomString = Str::random(5);
        $transactionCode = "TRX-$transactionNumber-$tiket->id-$randomString";
        $durasiPembayaran = 10; //menit
        $transaksi = Transaksi::create([
            'user_id' => auth()->user()->id,
            'tiket_id' => $tiket->id,
            'acara_id' => $tiket->jenisTiket->acara_id,
            'kode_transaksi' => $transactionCode,
            'jenis_pembayaran' => 'transfer',
            'token_pembayaran' => null,
            'tanggal_pembayaran' => null,
            'url_pembayaran' => null,
            'durasi_pembayaran' => $durasiPembayaran,
            'diskon' => null,
            'jumlah_dibayar' => null,
            'jumlah_diterima_disesuaikan' => null,
            'harga' => $tiket->harga,
            'total_pembayaran' => $tiket->harga,
            'status' => 'MENUNGGU',
            'batas_pembayaran' => Carbon::now()->addMinutes($durasiPembayaran),
        ]);
        return redirect()->route('landing-page.midtrans', $transaksi->kode_transaksi);
    }
    public function lanjut($kodeTransaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kodeTransaksi)->first();
        return redirect()->route('landing-page.midtrans', $transaksi->kode_transaksi);
    }
}

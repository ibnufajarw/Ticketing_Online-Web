<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Illuminate\Http\File;


class TransaksiController extends Controller
{
    public function index()
    {
        updateToKadaluarsa();
        $transaksi = Transaksi::when(auth()->user()->role == 'user', function ($query) {
            $query->whereHas('acara', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
        })->where('user_id', '!=', auth()->user()->id)->get();

        if (request()->ajax()) {
            $transaksi = $transaksi;
            return Datatables::of($transaksi)
                ->addColumn('user', function ($row) {
                    return $row->user->nama;
                })->addColumn('acara', function ($row) {
                    return $row->acara->judul . '<hr>' . $row->acara->waktu_mulai->translatedFormat('d M Y H:i');
                })

                ->addColumn('tiket', function ($row) {
                    return $row->tiket->kode . '-' . $row->tiket->tier . '-' . $row->tiket->kursi;
                })
                ->addColumn('harga', function ($row) {
                    return number_format($row->harga);
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'MENUNGGU') {
                        return '<span class="badge badge-warning">Menunggu</span>';
                    } elseif ($row->status == 'DIBAYAR') {
                        return '<span class="badge badge-success">Dibayar</span>';
                    } elseif ($row->status == 'KADALUARSA') {
                        return '<span class="badge badge-danger">Kadaluarsa</span>';
                    } elseif ($row->status == 'GAGAL') {
                        return '<span class="badge badge-danger">Gagal</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btnGroup = '<div class="btn-group" role="group">';

                    $btnDetail = '<a class="btn btn-success btn-sm" href="' . route('transaksi.detail', $row->kode_transaksi) . '"><i class="fas fa-list"></i> Detail</a>';
                    if ($row->status == 'MENUNGGU') {
                        $btnConfirm = '<a class="btn btn-success btn-sm ml-1"
                        data-target="#confirm" data-toggle="modal"
                        data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fas fa-check"></i> Konfirmasi</a>';
                    } else {
                        $btnConfirm = '';
                    }


                    $btnGroup .= $btnDetail . $btnConfirm;

                    $btnGroup .= '</div>';

                    return $btnGroup;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.transaksi.index');
    }
    public function uploadReceipt(Request $request)
    {
        if ($request->bukti_transfer) {
            $filename = Storage::disk('public')->putFile('image/transaksi/', $request->bukti_transfer);
        }
        $transaksi = Transaksi::find($request->id);
        $transaksi->update([
            'bukti_transfer' => $filename
        ]);
        return redirect()->route('landing-page.success')->with('success', 'Berhasil');
    }
    public function detail($kodeTransaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kodeTransaksi)->first();

        if ($transaksi->acara->user_id != auth()->user()->id) {
            return abort(404);
        }
        return view('dashboard.transaksi.show', compact('transaksi'));
    }
    public function invoice($kodeTransaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kodeTransaksi)->first();

        $pdf = PDF::loadView('dashboard.transaksi.invoice', compact('transaksi'));
        return $pdf->stream('invoice.pdf');
        // return view('dashboard.transaksi.invoice', compact('transaksi'));
    }



    public function confirm(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $transaksi->update([
            'status' => $request->status
        ]);

        if ($transaksi->status == 'DIBAYAR') {
            // Generate PDF
            $pdf = PDF::loadView('dashboard.transaksi.invoice', compact('transaksi'));
            $pdfContent = $pdf->output();

            // Generate unique filename for the PDF
            $filename = 'invoice_' . $transaksi->kode_transaksi . '.pdf';

            // Save PDF to storage
            $invoicePath = 'invoices/' . $filename;
            Storage::disk('public')->put($invoicePath, $pdfContent);

            $transaksi->update([
                'url_invoice' => $invoicePath
            ]);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil dikonfirmasi');
    }

    public function pembelianIndex()
    {
        updateToKadaluarsa();
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        if (request()->ajax()) {
            $transaksi = $transaksi;
            return Datatables::of($transaksi)
                ->addColumn('user', function ($row) {
                    return $row->user->nama;
                })->addColumn('acara', function ($row) {
                    return $row->acara->judul . '<hr>' . $row->acara->waktu_mulai->translatedFormat('d M Y H:i');
                })

                ->addColumn('tiket', function ($row) {
                    return $row->tiket->kode . '-' . $row->tiket->tier . '-' . $row->tiket->kursi;
                })
                ->addColumn('harga', function ($row) {
                    return number_format($row->harga);
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'MENUNGGU') {
                        return '<span class="badge badge-warning">Menunggu</span>';
                    } elseif ($row->status == 'DIBAYAR') {
                        return '<span class="badge badge-success">Dibayar</span>';
                    } elseif ($row->status == 'KADALUARSA') {
                        return '<span class="badge badge-danger">Kadaluarsa</span>';
                    } elseif ($row->status == 'GAGAL') {
                        return '<span class="badge badge-danger">Gagal</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btnGroup = '<div class="btn-group" role="group">';

                    $btnDetail = '<a class="btn btn-success btn-sm" href="' . route('transaksi.detail', $row->kode_transaksi) . '"><i class="fas fa-list"></i> Detail</a>';

                    $btnGroup .= $btnDetail;

                    $btnGroup .= '</div>';

                    return $btnGroup;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.transaksi.pembelian');
    }
}

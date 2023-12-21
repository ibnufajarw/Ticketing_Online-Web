@extends('template.landing-page.app')
@section('title', $acara->judul)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@push('styles')
    <style>
        .custom-caption {
            background-color: rgba(0, 0, 0, 0.6);
            /* Warna latar belakang semi-transparan */
            padding: 20px 1px 10px 10px;
            /* Padding di sekitar teks */
            color: white;
            /* Warna teks */
            /* Optional: tambahkan shadow */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            /* Shadow di bawah caption */
        }

        .carousel-inner {
            width: 100%;
            max-height: 100vh !important;
        }
    </style>
@endpush
@section('content')
    <div class="container py-5">
        <div class="row" style="margin-top: 50px;margin-bottom:50px;">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4>{!! $acara->judul !!}</h4>
                </div>
                <p class="fs-14 text-muted">{{ $acara->alamat }}</p>
                <p class="fs-14 text-muted mb-1"><i class="fa-regular fa-calendar me-1"></i>
                    {{ $acara->waktu_mulai->translatedFormat('d M Y H:i') }}
                    -
                    {{ $acara->waktu_selesai->translatedFormat('d M Y H:i') }}
                    <i class="fa-solid fa-circle ms-2 me-1"></i>
                </p>
                <p class="fs-14 text-muted">
                    Kuota : {{ $acara->kuota }} <br>
                    Kontak Panitia : {{ $acara->kontak }} <br>
                    Social Media : <a target="_blank"
                        href="https://{{ $acara->social_media ?? '-' }}">{!! $acara->social_media ?? '-' !!}</a>
                </p>
            </div>
            <div class="col-lg-8">
                <img src="{{ Storage::disk('local')->url($acara->thumbnail) }}" class="d-block mr-3"
                    style="max-height: 500px;">
            </div>
            <div class="col-12">
                <h5 class="mb-3 mt-3">Deskripsi</h5>
                <p class="fs-14">{!! $acara->deskripsi !!}</p>
                <h5 class="mb-3 mt-3">Peraturan Kegiatan</h5>
                <p class="fs-14">{!! $acara->peraturan !!}</p>
            </div>

            <hr>
            @if ($acara->jenisTiket)

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <p style="font-size: 25px;" class="mb-0">Jenis Tiket Yang Tersedia</p>
                        </div>
                        <br>
                        @foreach ($jenisTiket->tiket->sortBy('harga') as $key => $tiket)
                            <div class="card-body" style="padding-top:0;">
                                <p>
                                    Kode: {{ $tiket->kode }}-{{ $tiket->tier }} <br>
                                    <b>Rp. {{ number_format($tiket->harga) }}</b>
                                </p>
                                @if ($tiket->keuntungans->count() > 0)
                                    <hr style="border-top: 1px solid #DFDFDF;">
                                    <h4>Keuntungan</h4>
                                @endif
                                <ul>
                                    @foreach ($tiket->keuntungans as $keuntungan)
                                        <li>{{ $keuntungan->keuntungan }}</li>
                                    @endforeach
                                </ul>

                                @if (!auth()->check())
                                    <a href="{{ route('login', ['to_buy' => $tiket->id]) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-sign-in"></i>
                                        Masuk terlebih dahulu untuk membeli tiket</a>
                                @else
                                    @php
                                        $cek = cekTransaksiByTiket($tiket);
                                    @endphp
                                    @if ($cek)
                                        @if ($cek->user_id == auth()->user()->id)
                                            @if ($cek->status == 'MENUNGGU' && $cek->bukti_transfer == null)
                                                <a href="{{ route('transaksi.detail', $cek->kode_transaksi) }}"
                                                    style="width: 200px;" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-money-check"></i> Lanjutkan Pembayaran
                                                </a>
                                            @elseif($cek->bukti_transfer || $cek->status != 'MENUNGGU')
                                                <a href="{{ route('transaksi.detail', $cek->kode_transaksi) }}"
                                                    style="width: 200px;" class="btn btn-sm btn-success">
                                                    <i class="fas fa-eye"></i> Lihat Detail Transaksi
                                                </a>
                                            @endif
                                        @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary"
                                                style="width: 200px;">
                                                Sudah Terjual
                                            </a>
                                        @endif
                                    @else
                                        @if ($tiket->jenisTiket->acara->user_id != auth()->user()->id)
                                            <form action="{{ route('landing-page.acara.beli_tiket') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="tiket_id" value="{{ $tiket->id }}">
                                                <button type="submit" class="btn btn-primary" style="width: 200px;">
                                                    <i class="fas fa-money-check"></i> Beli Tiket
                                                </button>

                                            </form>
                                        @endif
                                    @endif
                                @endif

                                <hr style="border-top: 3px solid #DFDFDF;">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-warning">Tiket Belum Tersedia</div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endpush

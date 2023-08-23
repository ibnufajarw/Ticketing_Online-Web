@extends('template.landing-page.app')
@section('title', 'Jenis Tiket ' . $acara->judul)
@section('content')
    <div class="container py-5">
        <div class="row" style="margin-top: 50px;">
            <h3>Kategori Tiket</h3>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p style="font-size: 25px;">{{ $acara->judul }}</p>
                        <p class="fs-14 text-muted mb-1">
                            <i class="fa-regular fa-calendar me-1"></i>
                            {{ $acara->waktu_mulai->translatedFormat('d M Y H:i') }}
                            <i class="fa-solid fa-circle ms-2 me-1"></i>
                            {{ $acara->durasi_menit_estimasi . ' menit' }}
                        </p>
                    </div>
                    <br>
                    @foreach ($jenisTiket->tiket->sortBy('kursi') as $key => $tiket)
                        <div class="card-body" style="padding-top:0;">
                            <p>
                                Kode: {{ $tiket->kode }}-{{ $tiket->tier }} <br>
                                Kursi: {{ $tiket->kursi }} <br>
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
                                <a href="{{ route('login', ['to_buy' => $tiket->id]) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-sign-in"></i>
                                    Masuk terlebih dahulu untuk membeli tiket</a>
                            @else
                                @php
                                    $cek = cekTransaksiByTiket($tiket);
                                @endphp
                                @if ($cek)
                                    @if ($cek->user_id == auth()->user()->id)
                                        @if ($cek->status == 'MENUNGGU' && $cek->bukti_transfer == null)
                                            <a href="{{ route('landing-page.acara.lanjutkan_pembayaran', $cek->kode_transaksi) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-money-check"></i> Lanjutkan Pembayaran
                                            </a>
                                        @elseif($cek->bukti_transfer)
                                            <a href="{{ route('transaksi.detail', $cek->kode_transaksi) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Lihat Detail Transaksi
                                            </a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary">
                                            Sudah Terjual
                                        </a>
                                    @endif
                                @else
                                    @if ($tiket->jenisTiket->acara->user_id != auth()->user()->id)
                                        <form action="{{ route('landing-page.acara.beli_tiket') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="tiket_id" value="{{ $tiket->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary">
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
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endpush

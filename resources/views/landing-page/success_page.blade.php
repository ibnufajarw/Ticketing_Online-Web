@extends('template.landing-page.app')

@section('title', 'Pembayaran')

@section('content')

    <div class="container py-5">
        <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
                <img src="/img/success.png" style="height:300px;" class="mb-4" />
                <h2>
                    Transaksi sedang diproses!
                </h2>
                <p>
                    Silahkan tunggu konfirmasi dari kami
                </p>
                <div>
                    <a href="/" class="btn btn-success w-50 mt-2">
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

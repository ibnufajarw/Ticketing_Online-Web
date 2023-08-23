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
        <div class="row" style="margin-top: 50px;">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4>{{ $acara->judul }}</h4>
                </div>
                <p class="fs-14 text-muted">{{ $acara->alamat }}</p>
                <p class="fs-14 text-muted mb-1"><i class="fa-regular fa-calendar me-1"></i>
                    {{ $acara->waktu_mulai->translatedFormat('d M Y H:i') }} <i class="fa-solid fa-circle ms-2 me-1"></i>
                    {{ $acara->durasi_menit_estimasi . ' menit' }}</p>
                <p class="fs-14 text-muted">Kuota : {{ $acara->kuota }}</p>
                <div class="d-flex">
                    <img src="{{ Storage::disk('local')->url($acara->thumbnail) }}" class="d-block mr-3"
                        style="max-width: 300px;">
                    <div>
                        <h5 class="mb-3">Deskripsi</h5>
                        <p class="fs-14">{{ $acara->deskripsi }}</p>
                    </div>
                </div>
                <h5 class="mb-3 mt-3">Peraturan</h5>
                <p class="fs-14">{{ $acara->peraturan }}</p>
                @if ($acara->jenisTiket)
                    <a href="{{ route('landing-page.acara.detail_tiket', [$acara->slug, $acara->jenisTiket->id]) }}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-money-check"></i> Beli Tiket
                    </a>
                @else
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary">
                        <i class="fas fa-time"></i> Tiket Belum Tersedia
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endpush

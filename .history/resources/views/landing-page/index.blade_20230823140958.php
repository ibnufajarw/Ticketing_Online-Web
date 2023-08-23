@extends('template.landing-page.app')
@section('title', 'Beranda')
@section('content')
    <style>
        #carouselExampleIndicators>.carousel-control-next,
        #carouselExampleIndicators>.carousel-control-prev {
            width: 5% !important;
        }

        .custom-caption {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px 1px 10px 10px;
            color: white;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel .carousel-item#hero {
            height: 100vh;
        }

        .carousel-item#hero img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 100vh;
        }

        .carousel-caption {
            top: 80%;
            transform: translateY(-80%);
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }
    </style>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($slider as $key => $slid)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($slider as $key => $slid)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" id="hero">
                    <img class="d-block w-100" src="{{ Storage::disk('local')->url($slid->thumbnail) }}"
                        alt="Slide {{ $key }}">
                    <div class="carousel-caption d-none d-md-block custom-caption">
                        <h5>{{ $slid->judul }}</h5>
                        <p>{{ $slid->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container-fluid mt-3">
        <div class="row justify-content-center search-bar">
            <div class="col-lg-6 bg-white shadow-sm wrap-search-form rounded">
                <form action="{{ route('landing-page.index') }}" method="GET" id="search-form">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend bg-white border d-flex align-items-center">
                                <div class="input-group-text border-0 bg-white"><i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control fs-14 border-start-0" id="inlineFormInputGroup"
                                placeholder="Cari Sesuatu" name="q" value="{{ request()->q }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container py-5">
        @if (request()->q)
            <div class="alert alert-success">Ditemukan {{ $acara->total() }} acara kegiatan</div>
        @endif
        <h4 class="ml-4">Kategori Kegiatan <br>
            <small class="fs-14">Nikmatin acara dengan kategori kesukaan kamu</small>
        </h4>
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    @foreach ($kategori as $key => $kat)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="col-md-3">
                                <div class="card card-body" style="background: #E5E6EB !important;min-height: 200px;">
                                    <h5>{{ $kat->nama }}</h5>
                                    <p class="text-muted">{{ $kat->acara()->count() }} kegiatan acara</p>
                                    <img class="img-fluid" src="{{ Storage::disk('local')->url($kat->thumbnail) }}"
                                        style="height: 200px !important;object-fit:fill;">
                                    <form action="{{ route('landing-page.index') }}" method="GET">
                                        <input type="hidden" name="kategori_id" value="{{ $kat->id }}">
                                        <input type="hidden" name="q" value="{{ request()->q }}">
                                        <input type="hidden" name="kampus_id" value="{{ request()->kampus_id }}">
                                        <button type="submit"
                                            class="btn-block btn btn-sm btn-primary fs-14 mt-3">Selengkapnya</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container py-1">
        <h4 class="ml-4">Kegiatan Kampus <br>
            <small class="fs-14">Nikmatin acara kegiatan universitas</small>
        </h4>
        <div class="row mx-auto my-auto" id="kegiatan-kampus">
            <div id="kampusCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    @forelse ($kampus as $key => $k)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" id="kampus-item">
                            <div class="col-md-6">
                                <div class="card border-0 h-100">
                                    <div class="card-img-top"
                                        style="background-size: cover; background-image: url('{{ Storage::disk('local')->url($k->thumbnail) ?: asset('img/no_image.jpeg') }}'); height: 100%; width: 100%;">
                                        <div class="card-body shadow-sm text-center text-white">
                                            <h5 class="fw-700">{{ $k->nama }}</h5>
                                            <p class="fs-14">Cari kegiatan di kampus ini</p>
                                            <form action="{{ route('landing-page.index') }}" method="GET">
                                                <input type="hidden" name="kampus_id" value="{{ $k->id }}">
                                                <input type="hidden" name="q" value="{{ request()->q }}">
                                                <input type="hidden" name="kategori_id"
                                                    value="{{ request()->kategori_id }}">
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary fs-14 mt-3">Selengkapnya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev w-auto" href="#kampusCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#kampusCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>
    </div>
    <div class="container py-1">
        {{-- Acara Terbaru --}}
        <div class="row mt-5" id="acara-terbaru">
            <div class="col-lg-12">
                <h4>Acara Terbaru</h4>
                <div class="d-flex justify-content-between">
                    <p class="fs-14">Acara yang mungkin cocok untuk kamu</p>
                </div>
                <div class="row">
                    @forelse ($acara as $a)
                        <div class="col-lg-3 mb-3">
                            <div class="card border-0">
                                <div class="card-body shadow-sm py-3">
                                    <img src="{{ Storage::disk('local')->url($a->thumbnail) ?: asset('img/no_image.jpeg') }}"
                                        class="img-fluid">
                                    <h6 class="fs-14 fw-700 mt-3">{{ $a->judul }}</h6>
                                    <p class="fs-12 text-muted mb-0">{{ $a->waktu_mulai->translatedFormat('d M Y H:i') }}
                                    </p>
                                    {{-- <p class="fs-12 text-muted">{{ $a->lokasi->nama }}</p> --}}
                                    <div class="deskripsi d-flex">
                                        <div>
                                            <i class="fa-solid fa-hourglass-start fs-12"></i>
                                            <span class="fs-12">{{ $a->durasi_menit_estimasi }}</span>
                                        </div>
                                        <div class="ms-4">
                                            <i class="fa-solid fa-eye fs-12"></i>
                                            <span class="fs-12">{{ $a->view_count }}</span>
                                        </div>
                                        <div class="ms-4">
                                            <i class="fa-solid fa-users fs-12"></i>
                                            <span class="fs-12">{{ $a->kuota }}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex mt-3 justify-content-between align-items-end">
                                        @if ($a->jenisTiketBerbayar()->exists())
                                            <div>
                                                <p class="mb-0 fs-12">Mulai dari</p>
                                                <h6 class="mb-0"><span class="fw-700">Rp</span> <span
                                                        class="fs-12">{{ $a->jenisTiketBerbayar->tiketBerbayarStartFrom ? number_format($a->jenisTiketBerbayar->tiketBerbayarStartFrom->harga) : 0 }}</span>
                                                    @if ($a->jenisTiketGratis()->exists())
                                                        <span class="fs-12">| Gratis</span>
                                                    @endif
                                                </h6>
                                            </div>
                                        @else
                                            <div>
                                                <p class="mb-0 fs-12">Gratis</p>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('landing-page.acara.show', $a->slug) }}"
                                                class="btn btn-sm btn-primary fs-12">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12 text-center">
                            <p class="fs-14 text-muted">Belum ada data</p>
                        </div>
                    @endforelse
                    {{ $acara->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.carousel').carousel()
        $('#recipeCarousel').carousel({
            interval: 30000
        })
        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });
        $('#kampusCarousel').carousel({
            interval: 30000
        })
        $('#kampus-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });
        let typingTimer;
        const doneTypingInterval = 2000; // 2 detik
        $('#inlineFormInputGroup').on('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                $('#search-form').submit();
            }, doneTypingInterval);
        });
    </script>
@endpush

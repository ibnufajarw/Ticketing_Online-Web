@extends('template.landing-page.app')

@section('title', 'Kategori')

@section('content')
    @include('template.landing-page.partials._hero')

    <div class="container py-5">
        {{-- Kategori --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4>Semua Kategori</h4>
                <p class="fs-14">Nikmatin acara dengan kategori kesukaan kamu</p>
                <div class="row">
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Seni</a>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Teknologi</a>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Kesehatan</a>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Edukasi</a>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Musik</a>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="" class="btn btn-primary fs-14 shadow-sm">Olahraga</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
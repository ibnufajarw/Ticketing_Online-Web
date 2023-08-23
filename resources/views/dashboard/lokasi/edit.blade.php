@extends('template.dashboard.app')

@section('title', 'Lokasi')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Lokasi</h1>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            @include('dashboard.lokasi.partials._form')
        </div>
    </div>
@endsection
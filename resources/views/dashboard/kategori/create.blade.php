@extends('template.dashboard.app')

@section('title', 'Kategori')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kategori</h1>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            @include('dashboard.kategori.partials._form')
        </div>
    </div>
@endsection
@extends('template.dashboard.app')

@section('title', 'Kampus')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kampus</h1>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            @include('dashboard.kampus.partials._form')
        </div>
    </div>
@endsection
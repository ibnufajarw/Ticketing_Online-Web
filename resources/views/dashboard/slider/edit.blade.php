@extends('template.dashboard.app')

@section('title', 'Slider')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Slider</h1>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            @include('dashboard.slider.partials._form')
        </div>
    </div>
@endsection
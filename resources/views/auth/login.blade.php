@extends('template.landing-page.app')

@section('title', 'Login')

@push('styles')
@endpush

@section('content')
    <div class="container py-5">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5">
                @if(session('error'))
                    <div class="alert bg-danger fs-14 text-white">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @elseif(session('success'))
                    <div class="alert bg-success fs-14 text-white">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                <div class="card border-0">
                    <div class="card-body shadow-sm">
                        <h5 class="fw-700 text-primary">Log In</h5>
                        <form action="{{ url('/login') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="tiket_id" value="{{ request()->to_buy }}">
                            <div class="mb-3">
                                <label for="email" class="fs-14">Email</label>
                                <input type="email" class="form-control fs-14" name="email" value="{{ old('email') }}" id="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="fs-14">Password</label>
                                <input type="password" class="form-control fs-14" name="password" id="password" placeholder="Masukkan password" required>
                            </div>
                            <div class="mb-3">
                                <p class="fs-14 mb-1 text-muted">Belum punya akun? daftar <a class="text-primary text-decoration-none" href="{{ route('register') }}">disini</a></p>
                                <p class="fs-14 mb-1 text-muted"><a class="text-primary text-decoration-none" href="{{ route('reset') }}">Lupa Password</a></p>
                                <button type="submit" class="btn btn-primary fw-700 fs-14">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
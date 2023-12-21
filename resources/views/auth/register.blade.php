@extends('template.landing-page.app')

@section('title', 'Register')

@push('styles')
@endpush

@section('content')
    <div class="container py-5">
        <div class="row mt-5 justify-content-center pb-5">
            <div class="col-lg-5 ">
                @if (session('error'))
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
                        <h5 class="fw-700 text-primary">Register</h5>
                        <form action="{{ url('/register') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="fs-14">Username</label>
                                <input type="text" class="form-control fs-14 @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}"
                                    id="nama" placeholder="Masukkan username" required>
                                    @error('nama')
                                        <div class="invalid-feedback fs-14">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="fs-14">Email</label>
                                <input type="email" class="form-control fs-14 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" id="email" placeholder="Masukkan email"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback fs-14">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="fs-14">Password</label>
                                <input type="password" class="form-control fs-14 @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback fs-14">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="fs-14">Konfirmasi Password</label>
                                <input type="password" class="form-control fs-14" name="password_confirmation"
                                    id="password_confirmation" placeholder="Ulangi password" required>
                            </div>
                            <div class="mb-3">
                                <p class="fs-14 mb-1 text-muted">Sudah punya akun? masuk <a
                                        class="text-primary text-decoration-none" href="{{ route('login') }}">disini</a></p>
                                <button type="submit" class="btn btn-primary fw-700 fs-14">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

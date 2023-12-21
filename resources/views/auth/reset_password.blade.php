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
                        <h5 class="fw-700 text-primary">Reset Password</h5>
                        <form action="{{ route('reset_password_save') }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-3">
                                <label for="password" class="fs-14">New Password</label>
                                <input type="password" class="form-control fs-14 @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" id="password"
                                    placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback fs-14">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="fs-14">New Password Confirmation</label>
                                <input type="password"
                                    class="form-control fs-14 @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}"
                                    id="password_confirmation" placeholder="Masukkan Konfirmasi Password" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback fs-14">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary fw-700 fs-14">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

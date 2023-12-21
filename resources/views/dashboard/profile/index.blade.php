@extends('template.dashboard.app')
@section('title', 'Profile')
@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.cs"> --}}
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="white_shd full margin_bottom_30">

                        <div class="full price_table padding_infor_info">
                            <div class="row">
                                <!-- user profile section -->
                                <!-- profile image -->
                                <div class="col-12">
                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <h3>Ubah Password</h3>
                                    <!-- profile contant section -->
                                    <div class="full inner_elements margin_top_30">
                                        <div class="tab_style2">
                                            <div class="tabbar">
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="project_worked"
                                                        role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <form action="{{ route('profile.update_password') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="current_password">Password Lama</label>
                                                                <input type="password" name="current_password"
                                                                    id="current_password" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password">Password Baru</label>
                                                                <input type="password" name="new_password" id="new_password"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password_confirmation">Konfirmasi Password
                                                                    Baru</label>
                                                                <input type="password" name="new_password_confirmation"
                                                                    id="new_password_confirmation" class="form-control @error('new_password') is-invalid @enderror"
                                                                    required>
                                                                @error('new_password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-save"></i> Ubah</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end user profile section -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EasyIN - @yield('title')</title>
    @include('template.dashboard.partials._style')
</head>
<body id="page-top">
    <div id="wrapper">
        @if(auth()->user()->role == 'admin')
        @include('template.dashboard.partials._admin_sidebar')
        @else
        @include('template.dashboard.partials._user_sidebar')
        @endif
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('template.dashboard.partials._navbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('template.dashboard.partials._footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('template.dashboard.partials._script')
</body>
</html>

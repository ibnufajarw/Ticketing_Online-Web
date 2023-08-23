<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyIN - @yield('title')</title>

    @include('template.landing-page.partials._style')
</head>
<style>
    body {
        min-height: 100vh;
    }

    .footer-fixed {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #333;
        /* Customize the background color as needed */
        color: white;
        /* Customize the text color as needed */
        padding: 10px 0;
    }
</style>

<body class="bg-light">
    {{-- navbar --}}
    @include('template.landing-page.partials._navbar')

    @yield('content')

    {{-- footer --}}
    @include('template.landing-page.partials._footer')

    @include('template.landing-page.partials._script')
</body>

</html>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Rekayasa-Web</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.5-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/toastr.min.css')}}">
    {{-- Javascript --}}
    <script src="{{asset('assets/jquery-3.6.1.js')}}"></script>
    <script src="{{asset('assets/datatables.min.js')}}"></script>
    <script src="{{asset('assets/toastr.min.js')}}"></script>
    <script src="{{ asset('bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
    {{-- Navbar --}}
    @include('partials.header')

    {{-- Konten --}}
    
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer') 
</body>
</html>

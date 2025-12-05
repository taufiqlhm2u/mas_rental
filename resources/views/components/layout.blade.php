<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- icon web -->
    <link rel="shortcut icon" href="{{ asset('img/masrental.png') }}" type="image/png">
    <!-- bootstrap -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
    @if (Auth::user()->user_status == 'admin')
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @endif

     @stack('css')
</head>

<body>
    @if (Auth::user()->user_status == 'admin')
        <x-sidebar>{{ $slot }}</x-sidebar>
        <script src="{{ asset('js/sidebar.js') }}"></script>
    @else
    <x-navbar></x-navbar>
        {{ $slot }}
    <x-footer></x-footer>
    @endif

    @include('sweetalert::alert')
</body>

</html>
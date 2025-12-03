<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masrental</title>

    <!-- icon web -->
     <link rel="shortcut icon" href="{{ asset('img/masrental.png') }}" type="image/png">
     <!-- bootstrap -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- remixicon -->
     <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
/>
 
</head>
<body>


      @include('sweetalert::alert')
</body>
</html>
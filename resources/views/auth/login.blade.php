<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- remixicon -->
     <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
/>

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body class="d-flex justify-content-center align-items-center">

    @if (session('error'))
        
        <div id="infoerror">
        <div class="alert alert-danger">
             <i class="ri-error-warning-fill"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="d-flex shadow login-box">
        <div class="hero-img">
            <!-- <img src="{{ asset('img/login.jpg') }}" width="250" alt="" style="border-radius: 8px;"> -->
        </div>
        <div class="card border-0" style="width: 400px;">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                <form action="/cekLogin" method="post">
                    @csrf

                    <div>
                        <div class="form-floating mb-4">
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="masukan username" autocomplete="off">
                            <label for="username">username</label>

                            @error('username')
                                <p class="text-danger">{{ ucwords($message) }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukan Password">
                            <label for="password">Password</label>
                            @error('password')
                                <p class="text-danger">{{ ucwords($message) }}</p>
                            @enderror
                        </div>
                    </div>

                     <p>Belum punya akun? <a href="/daftar">Daftar</a></p>
                    <div>
                        <button class="btn btn-primary" type="submit" style="width:100%;">Login</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    <script>
        $('#infoerror').fadeIn(1000).delay(10000).fadeOut(1000);
    </script>
</body>

</html>
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        #infoerror {
            display: none;
        }
    </style>
</head>

<body style="height:100vh; background: #f4f4f4;" class="d-flex justify-content-center align-items-center">

    @if (session('error'))

        <div style="position: absolute; top: 20px; left:50%; transform: translate(-50%); z-index: 2;" id="infoerror">
            <div class="alert alert-danger" style="width: 400px;">
                <i class="ri-error-warning-fill" style="font-size:18px;"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="d-flex shadow" style="border-radius: 8px; background-color: #fff;">
        <div class="card border-0" style="width: 400px;">
            <div class="card-header">
                <h2>Daftar</h2>
            </div>
            <div class="card-body">
                <form action="/daftar" method="post">
                    @csrf

                    <div>
                        <div class="form-floating mb-4">
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="masukan username" autocomplete="off">
                            <label for="username">Buat Username</label>

                            @error('username')
                                <p class="text-danger">{{ ucwords($message) }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="masukan nama"
                                autocomplete="off">
                            <label for="nama">Nama Lengkap</label>

                            @error('nama')
                                <p class="text-danger">{{ ucwords($message) }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="form-floating mb-4">
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                placeholder="masukan alamat" autocomplete="off">
                            <label for="alamat">Alamat Lengkap</label>

                            @error('alamat')
                                <p class="text-danger">{{ ucwords($message) }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukan Password">
                        <label for="password">Buat Password</label>
                        @error('password')
                            <p class="text-danger">{{ ucwords($message) }}</p>
                        @enderror
                    </div>

                    <p>Sudah punya akun? <a href="/login">login</a></p>
                    <div>
                        <button class="btn btn-primary" type="submit" style="width:100%;">kirim</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        $('#infoerror').fadeIn(1000).delay(10000).fadeOut(1000);
    </script>
</body>

</html>
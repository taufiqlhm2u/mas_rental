<div class="navbar navbar-expand-lg " style="background: #1B3C53; position: relative; z-index: 2;">
    <div class="container-fluid">
        <a href="/dashboard" class="navbar-brand fw-bold" style="color:#f5f5f5;">Masrental</a>
        <button class="navbar-toggler" style="color:white;" data-bs-toggle="collapse" type="button"
            data-bs-target="#navbarMas" aria-controls="navbarMas" aria-expanded="false" aria-label="Togel navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMas">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <x-nav-link href="/dashboard" :active="request()->is('dashboard') ? true : false"><i
                                class="ri-home-5-fill"></i>Dashboard</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/rental" :active="request()->is('rental') ? true : false"><i
                                class="ri-p2p-fill"></i>Rental saya</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/kendaraan" :active="request()->is('kendaraan') ? true : false"><i
                                class="ri-car-line"></i>Kendaraan</x-nav-link>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdow" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color:#DEDED1;"><i class="ri-settings-3-line"></i>Pengaturan</a>

                        <ul class="dropdown-menu" aria-labelledby="dropdown">
                            <li class="dropdown-item">
                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#modalProfile"
                                    class="nav-link"><i class="ri-account-circle-line"></i>Ubah Profile</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#modalPw"
                                    class="nav-link"><i class="ri-lock-password-line"></i>Ganti Password</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" onclick="return confirm('yakin pengen keluar');"
                            class="nav-link text-danger fw-semibold"><i class="ri-logout-box-line"></i>Logout</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <span class="nav-link text-white">Halo, {{ auth()->user()->user_nama }}</span>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="/login" class="btn" style="color: #E3E3E3;">Log In</a>
                        <a href="/daftar" class="btn" style="border: 1px solid #456882; color: #E3E3E3;">Daftar</a>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</div>
@auth
<x-profile></x-profile>
@endauth
</div>
<style>
    .nav-link:hover {
        text-decoration: underline;
    }
</style>
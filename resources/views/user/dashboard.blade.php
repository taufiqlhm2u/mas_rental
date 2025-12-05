
<x-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="navbar navbar-expand-lg " style="background: #1B3C53;">
        <div class="container-fluid">
            <a href="/dashboard" class="navbar-brand text-white fw-bold">Masrental</a>
            <button class="navbar-toggler" style="color:white;" data-bs-toggle="collapse" type="button" data-bs-target="#navbarMas" aria-controls="navbarMas" aria-expanded="false" aria-label="Togel navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMas">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link text-white underline active">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="/rental" class="nav-link" style="color:#e3e3e3;">Rental saya</a>
                </li>
            </ul>
            </div>
           
        </div>
    </div>
</x-layout>
<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
    @endpush

    <div>
        <div class="container py-5">

            <div class="section">
                <h4 class="mb-3 fw-bold">Informasi</h4>

                <div class="alert alert-info" role="alert">
                    Selamat datang di dashboard pengguna! Di sini Anda dapat mengelola peminjaman kendaraan, melihat
                    status peminjaman Anda, dan memperbarui profil Anda. Gunakan menu navigasi untuk mengakses
                    fitur-fitur yang tersedia. Jika Anda membutuhkan bantuan, silakan hubungi tim dukungan kami.
                </div>
            </div>

            <div class="section">
                <h4 class="mb-4 fw-bold">Ringkasan Rental</h4>

                <div class="d-flex justify-content-center flex-wrap gap-4">
                    <div class="card border-0 shadow kartu" id="rental">
                        <div class="py-2 px-3 mt-2">
                            <span>Sedang dirental</span>
                            <div class="caption">
                                <p><i class="ri-car-line"></i> <span>{{ $rental }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow kartu" id="booking">
                        <div class="py-2 px-3 mt-2">
                            <span>Booking</span>
                            <div class="caption">
                                <p><i class="ri-calendar-schedule-line"></i> <span>{{ $book }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow kartu" id="today">
                        <div class="py-2 px-3 mt-2">
                            <span>Tengat hari ini</span>
                            <div class="caption">
                                <p><i class="ri-time-line"></i> <span>{{ $tengat }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow kartu" id="telat">
                        <div class="py-2 px-3 mt-2">
                            <span>Melewati tengat waktu</span>
                            <div class="caption">
                                <p><i class="ri-calendar-close-fill"></i> <span>{{ $telat }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow kartu" id="selesai">
                        <div class="py-2 px-3 mt-2">
                            <span>Selesai</span>
                            <div class="caption">
                                <p><i class="ri-checkbox-circle-line"></i> <span>{{ $selesai }}</span></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="section">
                <h4 class="mb-3 fw-bold">Rental Saya</h4>

                @if($pinjam->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Anda belum melakukan peminjaman kendaraan. Silakan lakukan peminjaman untuk melihat detail
                        rental Anda di sini.
                    </div>
                @else
                <div>
                   @foreach ($pinjam as $rental)
                    <div class="card" style="width: 15rem; margin-bottom: 15px;">
                        <img src="{{ asset('img/upload/' . $rental->kendaraan_gambar) }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rental->kendaraan_nama }} {{ $rental->kendaraan_tipe }}</h5>
                            <p class="card-text">Status: {{ ucfirst($rental->pinjam_status) }}</p>
                           
                    </div>
                   @endforeach
                </div>
                @endif

            </div>


        </div>
    </div>

</x-layout>
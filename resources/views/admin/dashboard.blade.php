<x-layout>
    <x-slot:title>Dashboard</x-slot:title>
    @push('css')
        <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    @endpush
    <div class="mt-2 hero-img">
    </div>
    <div class="d-flex justify-content-evenly m-4" id="quickinfo">

        <div class="card border-0 kartu" id="user">
            <div class="py-2 px-3">
                <span>User</span>
                <div>
                    <p><i class="ri-user-line"></i> <span>{{ $jumlahUser }}</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" id="kendaraan">
            <div class="py-2 px-3">
                <span>Kendaraan</span>
                <div>
                    <p><i class="ri-car-line"></i> <span>{{ $jumlahKendaraan }}</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" id="rental">
            <div class="py-2 px-3">
                <span>Sedang di pinjam</span>
                <div>
                    <p><i class="ri-p2p-fill"></i> <span>{{ $jumlahPinjam }}</span></p>
                </div>
            </div>
        </div>

        <div class="card border-0 kartu" id="tempo">
            <div class="py-2 px-3">
                <span>Jatuh tempo hari ini</span>
                <div>
                    <p><i class="ri-calendar-schedule-line"></i> <span>{{ $jumlahToday }}</span></p>
                </div>
            </div>
        </div>
    </div>

</x-layout>
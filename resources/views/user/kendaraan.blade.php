<x-layout>
    <x-slot:title>Kendaraan</x-slot:title>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/user/kendaraan.css') }}">
    @endpush
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Daftar Kendaraan</h4>
            <form action="/kendaraan/search" method="post">
                @csrf
                <input type="search" name="search" id="" placeholder="Cari kendaraan" autocomplete="off" class="form-control"
                    style="width: 250px;">
            </form>
        </div>

        <div class="d-flex flex-wrap gap-4 justify-content-center mt-4">

            @foreach ($kendaraan as $k)
                <div class="card border-0 shadow overflow-hidden" style="width: 15rem; border-radius: 14px;">
                    <div class="position-relative">
                        <img src="{{ asset('img/upload/' . $k->kendaraan_gambar) }}" class="card-img-top" alt="Mobil"
                            style="height: 160px; object-fit: cover;">
                        @if ($k->kendaraan_status == 'ready')
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1"
                                style="font-size: .75rem; border-radius: 6px;" id="ready">
                                {{ strtoupper($k->kendaraan_status) }}
                            </span>
                        @elseif ($k->kendaraan_status == 'booking')
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1"
                                style="font-size: .75rem; border-radius: 6px;" id="booking">
                                {{ strtoupper($k->kendaraan_status) }}
                            </span>
                        @else
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1"
                                style="font-size: .75rem; border-radius: 6px;" id="rental">
                                {{ strtoupper($k->kendaraan_status) }}
                            </span>
                        @endif
                    </div>

                    <div class="card-body py-3">
                        <h6 class="fw-semibold mb-1" style="font-size: 0.95rem;">{{ $k->kendaraan_nama }}</h6>
                        <span class="text-secondary" style="font-size: 0.8rem;">{{ $k->kendaraan_tipe }}</span>

                        <div class="mt-2 mb-3">
                            <span class="fw-bold"
                                style="font-size: 1.1rem;">{{ 'Rp' . number_format($k->kendaraan_harga_perhari, 0, '', '.') }}</span>
                            <span class="text-secondary" style="font-size: .75rem;">/ hari</span>
                        </div>

                        @if ($k->kendaraan_status == 'ready')
                            <a href="#" class="btn btn-primary w-100 py-2 fw-semibold"
                                style="font-size: .9rem; border-radius: 8px;">
                                Rental
                            </a>
                        @else
                            <button type="button" class="btn border-secondary text-secondary w-100 py-2 fw-semibold"
                                style="font-size: .9rem; border-radius: 8px;">
                                Rental
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
        <div class="links mt-4 px-3">
            {{ $kendaraan->links() }}
        </div>
    </div>
</x-layout>
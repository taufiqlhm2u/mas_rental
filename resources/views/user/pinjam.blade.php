<x-layout>
    <x-slot:title>Daftar rental</x-slot:title>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/user/pinjam.css') }}">
    @endpush

    <div>
        <div class="container py-5">
            <div class="section mb-3">
                <h4 class="mb-3 fw-bold">Tengat hari ini</h4>

                <div>
                    @if ($tengat->count() > 0)
                       <div class="d-flex gap-4 flex-wrap">
                         @foreach ($tengat as $t)
                            <div class="card" style="width: 15rem; margin-bottom: 13px;">
                                <img src="{{ asset('img/upload/' . $t->kendaraan_gambar) }}" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $t->kendaraan_nama }} {{ $t->kendaraan_tipe }}</h5>
                                    <span class="card-text d-block">Status: {{ ucfirst($t->pinjam_status) }}</span>
                                    <span class="card-text d-block">Harga:
                                        Rp{{ number_format($t->kendaraan_harga_perhari, 0, '', '.') }}</span>
                                </div>
                        @endforeach
                       </div>
                    @else
                            <div class="alert alert-info" role="alert">
                                Tidak ada rental yang memiliki tengat hari ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="section bg-white p-4 rounded-3 mx-5 shadow-sm mb-5 " style="max-height: 450px;">
                <h4 class="mb-4 fw-bold">Daftar Rental</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="table-dark">
                                <th width="1%">No</th>
                                <th>Kendaraan</th>
                                <th>Harga (perhari)</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Harus Kembali</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if ($rental->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data rental tersedia.</td>
                                </tr>
                           @else
                            @foreach ($rental as $no => $r)
                                <tr>
                                    <th class="text-nowrap">{{ $no + 1 }}</th>
                                    <td class="text-nowrap">{{ ucwords($r->kendaraan_nama) }}</td>
                                    <td class="text-nowrap">Rp{{ number_format($r->kendaraan_harga_perhari, 0, '', '.') }}
                                    </td>
                                    <td class="text-nowrap text-center">{{ $r->tgl_pinjam ? $r->tgl_pinjam : '-'  }}</td>
                                    <td class="text-nowrap text-center">
                                        {{ $r->tgl_harus_kembali ? $r->tgl_harus_kembali : '-'  }}
                                    </td>
                                    <td class="text-nowrap text-center">{{ $r->tgl_kembali ? $r->tgl_kembali : '-' }}</td>
                                    <td class="text-nowrap">
                                        @if ($r->pinjam_status == 'dipinjam')
                                            <span class="status status-pinjam">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'booking')
                                            <span class="status status-booking">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'dibatalkan')
                                            <span class="status status-batal">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'dikembalikan')
                                            <span class="status status-kembali">{{ ucfirst($r->pinjam_status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap d-flex gap-2">
                                        <!-- ------- button batalkan -------- -->
                                        @if ($r->pinjam_status == 'booking')
                                            <a href="{{ route('rentalCancel', $r->pinjam_id) }}" data-confirm-delete="true" class="aksi btn btn-danger" confirm-delete="true">
                                                <i class="ri-close-circle-line"></i>Batal
                                            </a>
                                        @else
                                            <span data-confirm-delete="true"
                                                class="aksi text-secondary border-0 bg-transparent">
                                                <i class="ri-close-circle-line"></i>Batal
                                            </span>


                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                           @endif

                        </tbody>
                    </table>
                </div>
                <div class="px-3">
                    {{ $rental->links() }}
                </div>

            </div>


        </div>

</x-layout>
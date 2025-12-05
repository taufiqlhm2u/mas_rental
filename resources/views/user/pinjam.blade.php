<x-layout>
    <x-slot:title>Daftar rental</x-slot:title>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/user/pinjam.css') }}">
    @endpush

    <div>
        <div class="container py-5">

            <div class="section">
                <h4 class="mb-3 fw-bold">Tengat hari ini</h4>

                <div >
                    
                </div>
            </div>

            <div class="section">
                <h4 class="mb-4 fw-bold">Daftar Rental</h4>
             <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th width="1%">No</th>
                            <th>Kendaraan</th>
                            <th>Harga</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Harus Kembali</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rental as $no => $r)
                            <tr>
                                <th class="text-nowrap">{{ $no + 1 }}</th>
                                <td class="text-nowrap">{{ ucwords($r->kendaraan_nama) }}</td>
                                <td class="text-nowrap">{{ $r->kendaraan_harga_perhari }}</td>
                                <td class="text-nowrap">{{ $r->tgl_pinjam }}</td>
                                <td class="text-nowrap">{{ $r->tgl_harus_kembali }}</td>
                                <td class="text-nowrap">{{ $r->tgl_selesai }}</td>
                                <td class="text-nowrap">
                                    @if ($r->pinjam_status == 'ready')
                                        <span class="status-admin">{{ ucfirst($r->pinjam_status) }}</span>
                                    @else
                                        <span class="status-user">{{ ucfirst($r->pinjam_status) }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap d-flex gap-2">
                                    <!-- ------- button hapus -------- -->
                                    <a href="" data-confirm-delete="true"
                                        class="aksi text-danger">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
              

            </div>

            <div class="section">
                <h4 class="mb-3 fw-bold">Rental Saya</h4>


            </div>


        </div>
    </div>

</x-layout>
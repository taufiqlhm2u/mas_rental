<x-layout>
    <x-slot:title>Management Kendaraan</x-slot:title>


    <!-- untuk menampilkan error -->
    @if ($errors->any())

        <div style="position: absolute; top: 20px; left:50%; transform: translate(-50%);" id="infoerror">
            <div class="alert alert-danger" style="width: 400px;">
                <p>Pesan error!!</p>
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="m-4">
        <h4>Management Kendaraan</h4>
        <div class="mt-3 bg-white p-2 rounded shadow">
            <div class="d-flex justify-content-between mb-3 mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahKendaraan">Tambah</button>
                <form action="/admin/kendaraan/search/" method="get" style="width:200px;">
                    <input type="search" name="search" id="" placeholder="Cari kendaraan" class="form-control"
                        autocomplete="off">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr class="table-dark">
                            <th width="1%">No</th>
                            <th>Gambar</th>
                            <th>Nama Kendaraan</th>
                            <th>Tipe</th>
                            <th width="1%" class="text-nowrap">Nomor Kendaraan</th>
                            <th>Harga (perhari)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraan as $no => $k)
                            <tr>
                                <th class="text-nowrap">{{ $no + 1 }}</th>
                                <td class="text-nowrap">
                                    <div>
                                        <img src="{{ asset('img/upload/' . $k->kendaraan_gambar) }}" alt="" width="120">
                                    </div>
                                </td>
                                <td class="text-nowrap">{{ ucwords($k->kendaraan_nama) }}</td>
                                <td class="text-nowrap">{{ $k->kendaraan_tipe }}</td>
                                <td class="text-nowrap text-center">{{ $k->kendaraan_nomor }}</td>
                                <td class="text-nowrap">
                                    {{ 'Rp ' . number_format($k->kendaraan_harga_perhari, 0, '.', '.')}}
                                </td>
                                <td class="text-nowrap">
                                    @if ($k->kendaraan_status == 'ready')
                                        <span class="status-ready">{{ ucfirst($k->kendaraan_status) }}</span>
                                    @elseif ($k->kendaraan_status == 'booking')
                                        <span class="status-booking">{{ ucfirst($k->kendaraan_status) }}</span>
                                    @else
                                        <span class="status-dirental">{{ ucfirst($k->kendaraan_status) }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap" style="font-size: 20px;">
                                    <!-- ----- button edit ------ -->
                                    <a href="#" class="editModal aksi text-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-nama="{{ $k->kendaraan_nama }}"
                                        data-tipe="{{ $k->kendaraan_tipe }}" data-harga="{{ $k->kendaraan_harga_perhari }}"
                                        data-nomor="{{ $k->kendaraan_nomor }}" data-gambar="{{ $k->kendaraan_gambar }}"
                                        data-status="{{ $k->kendaraan_status }}">
                                        <i class="ri-edit-2-fill"></i>
                                    </a>

                                    <!-- ------- button hapus -------- -->
                                    <a href="{{ route('admin.kendaraan.destroy', $k->kendaraan_nomor) }}"
                                        data-confirm-delete="true" class="aksi text-danger">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-2 mt-3">
                {{ $kendaraan->links() }}
            </div>
        </div>
    </div>

    <!-------------------------------------- modal untuk tambah data ------------------------------------------->

    <div class="modal fade" id="tambahKendaraan" tabindex="-1" aria-labelledby="Tambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Kendaraan Rental</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/kendaraan/store" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="nama kendaraan"
                                autocomplete="off" required>
                            <label for="nama">Nama kendaraan</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="tipe" class="form-control" id="tipe" placeholder="masukan tipe"
                                autocomplete="off" required>
                            <label for="tipe">Tipe kendaraan</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" name="harga" class="form-control" id="harga"
                                placeholder="masukan harga" autocomplete="off" required>
                            <label for="harga">Harga perhari</label>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="for-label mb-1">Pilih gambar <i>(png, jpg, jpeg,
                                    webp)</i></label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="close">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ------------------------------------ modal untuk edit user ----------------------------------------- -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="Edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Kendaraan Rental</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/kendaraan/update" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="kendaraan_nomor" id="kendaraan_nomor">
                        <input type="hidden" name="old_gambar" id="old_gambar">
                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="editNama"
                                placeholder="nama kendaraan" autocomplete="off" required>
                            <label for="nama">Nama kendaraan</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="tipe" class="form-control" id="editTipe" placeholder="masukan tipe"
                                autocomplete="off" required>
                            <label for="tipe">Tipe kendaraan</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" name="harga" class="form-control" id="editHarga"
                                placeholder="masukan harga" autocomplete="off" required>
                            <label for="harga">Harga perhari</label>
                        </div>

                        <div class="form-group mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option>Pilih status</option>
                                <option value="ready">Ready</option>
                                <option value="booking">Booking</option>
                                <option value="dirental">Dirental</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="for-label mb-1">Pilih gambar <i>(png, jpg, jpeg,
                                    webp)</i></label>
                            <input type="file" name="gambar" id="editGambar" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="close">Batal</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        table tbody tr td span {
            display: block;
            width: 90px;
            text-align: center;
            border-radius: 4px;
        }

        .status-ready {
            background: #D4F6DF;
            color: #2F9E44;
        }

        .status-booking {
            background: #FFF6D7;
            color: #E2A20B;
        }

        .status-dirental {
            background: #FFE1E1;
            color: #D93025;
        }

        td .aksi:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        $('.editModal').click(function () {
            var nomor = $(this).data('nomor');
            var nama = $(this).data('nama');
            var tipe = $(this).data('tipe');
            var harga = $(this).data('harga');
            var status = $(this).data('status');
            var gambar = $(this).data('gambar');

            $('#editHarga').val(harga);
            $('#kendaraan_nomor').val(nomor);
            $('#editNama').val(nama);
            $('#editTipe').val(tipe);
            $('#editStatus').val(status);
            $('#old_gambar').val(gambar);

        });

        $('#infoerror').fadeIn(1000).delay(10000).fadeOut(1000);

    </script>
</x-layout>
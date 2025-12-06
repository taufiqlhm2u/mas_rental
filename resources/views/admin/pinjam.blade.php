<x-layout>
    <x-slot:title>Management Peminjaman</x-slot:title>


    <!-- untuk menampilkan error -->
        @if ($errors->any())
        
        <div style="position: absolute; top: 20px; left:50%; transform: translate(-50%);" id="infoerror">
        <div class="alert alert-danger"  style="width: 400px;">
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
        <h4>Management Peminjaman</h4>
        <div class="mt-3 bg-white p-2 rounded shadow">
            <div class="d-flex justify-content-between mb-3 mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
                <form action="/admin/rental/search/" method="get" style="width:200px;">
                    <input type="search" name="search" id="" placeholder="Cari peminjaman" class="form-control"
                        autocomplete="off">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th width="1%">No</th>
                            <th>Nama Peminjam</th>
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
                        @foreach ($pinjam as $no => $r)
                            <tr>
                                <th class="text-nowrap">{{ $no + 1 }}</th>
                                <td class="text-nowrap">{{ ucwords($r->user_nama) }}</td>
                                <td class="text-nowrap">{{ ucwords($r->kendaraan_nama) . ' [' . ucwords($r->kendaraan_tipe) . ']' }}</td>
                                <td class="text-nowrap">Rp{{ number_format( $r->kendaraan_harga_perhari, 0, '', '.') }}</td>
                                <td class="text-nowrap text-center">{{ $r->tgl_pinjam ? $r->tgl_pinjam : '-' }}</td>
                                <td class="text-nowrap text-center">{{ $r->tgl_harus_kembali ? $r->tgl_harus_kembali : '-' }}</td>
                                <td class="text-nowrap text-center">{{ $r->tgl_kembali ? $r->tgl_kembali : '-' }}</td>
                                <td class="text-nowrap">
                                    @if ($r->pinjam_status == 'dipinjam')
                                            <span class="status status-pinjam">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'booking')
                                            <span class="status status-booking">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'dibatalkan')
                                            <span class="status status-batal">{{ ucfirst($r->pinjam_status) }}</span>
                                        @elseif ($r->pinjam_status == 'dikembalikan')
                                            <span class="status status-kembali">Kembali</span>
                                        @endif
                                </td>
                                <td class="text-nowrap d-flex gap-2">
                                    <!-- ----- button edit ------ -->
                                   @if ($r->pinjam_status == 'dikembalikan')
                                      <a href="#" class="editModal aksi text-secondary" data-bs-toggle="modal">
                                            <i class="ri-edit-2-fill"></i>
                                    </a>
                                   @elseif ($r->pinjam_status == 'dibatalkan')
                                    <a href="#" class="editModal aksi text-secondary" data-bs-toggle="modal">
                                            <i class="ri-edit-2-fill"></i>
                                    </a>
                                   @else
                                     <a href="#" class="editModal aksi text-primary" data-bs-toggle="modal"
                                    data-user="{{ $r->user_nama }}"
                                    data-kendaraan="{{ $r->kendaraan_nama }}"
                                    data-pinjam="{{ $r->tgl_pinjam }}"
                                    data-harus_kembali="{{ $r->tgl_harus_kembali }}"
                                    data-kembali="{{ $r->tgl_kembali }}"
                                    data-status="{{ $r->pinjam_status }}"
                                    data-id="{{ $r->pinjam_id }}"
                                        data-bs-target="#edit">
                                            <i class="ri-edit-2-fill"></i>
                                    </a>
                                    @endif

                                    <!-- ------- button hapus -------- -->
                                    <a href="{{ route('admin.rental.destroy', $r->pinjam_id) }}" data-confirm-delete="true"
                                        class="aksi text-danger">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-2 mt-3">
                {{ $pinjam->links() }}
            </div>
        </div>
    </div>

    <!-------------------------------------- modal untuk tambah data ------------------------------------------->

    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="userTambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Pinjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/rental/store" method="post">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="user" class="form-label">User</label>
                            <select name="user" id="user" class="form-select" required>
                                <option>Pilih User</option>
                                @foreach ($user as $u)
                                <option value="{{ $u->user_id }}">{{ $u->username . '-' .  $u->user_nama}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="kendaraan" class="form-label">Kendaraan</label>
                            <select name="kendaraan" id="kendaraan" class="form-select" required>
                                <option>Pilih kendaraan</option>
                                @foreach ($kendaraan as $u)
                                <option value="{{ $u->kendaraan_nomor }}">{{ $u->kendaraan_nama . '-' .  $u->kendaraan_tipe}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class=" mb-4">
                            <label for="tgl_pinjam" class="form-label">Tgl pinjam</label>
                            <input type="date" name="tgl_pinjam" class="form-control" id="tgl_pinjam"
                                placeholder="masukan tgl_pinjam" autocomplete="off">
                        </div>

                        <div class=" mb-4">
                            <label for="tgl_harus_kembali" class="form-label">Tgl harus kembali</label>
                            <input type="date" name="tgl_harus_kembali" class="form-control" id="tgl_harus_kembali"
                                placeholder="masukan tgl_harus_kembali" autocomplete="off">
                        </div>

                        <div class=" mb-4">
                            <label for="tgl_kembali" class="form-label">Tgl kembali</label>
                            <input type="date" name="tgl_kembali" class="form-control" id="tgl_kembali"
                                placeholder="masukan tgl_kembali" autocomplete="off">
                        </div>

                           <div class="form-group mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option>Pilih status</option>
                                <option value="booking">Booking</option>
                                <option value="dipinjam">dipinjam</option>
                                <option value="dikembalikan">dikembalikan</option>
                                <option value="dibatalkan">dibatalkan</option>
                            </select>
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


    <!-- ------------------------------------ modal untuk edit ----------------------------------------- -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="userTambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Pinjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/rental/update" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="pinjam_id" id="pinjam_id">

                        <h4 id="peminjaman"></h4>

                        <div class=" mb-4">
                            <label for="tgl_pinjam" class="form-label">Tgl pinjam</label>
                            <input type="date" name="tgl_pinjam" class="form-control" id="tgl_pinjamEdit"
                                placeholder="masukan tgl_pinjam" autocomplete="off">
                        </div>

                        <div class=" mb-4">
                            <label for="tgl_harus_kembali" class="form-label">Tgl harus kembali</label>
                            <input type="date" name="tgl_harus_kembali" class="form-control" id="tgl_harus_kembaliEdit"
                                placeholder="masukan tgl_harus_kembali" autocomplete="off">
                        </div>

                        <div class=" mb-4">
                            <label for="tgl_kembali" class="form-label">Tgl kembali</label>
                            <input type="date" name="tgl_kembali" class="form-control" id="tgl_kembaliEdit"
                                placeholder="masukan tgl_kembali" autocomplete="off">
                        </div>

                           <div class="form-group mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="statusEdit" class="form-select" required>
                                <option>Pilih status</option>
                                <option value="booking">Booking</option>
                                <option value="dipinjam">dipinjam</option>
                                <option value="dikembalikan">dikembalikan</option>
                                <option value="dibatalkan">dibatalkan</option>
                            </select>
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
            width: 100px;
            text-align: center;
            border-radius: 4px;
        }

        .status-pinjam {
    background-color: #d8eefe;
    color: #2994f2;
}

.status-booking {
    background-color: #e8e3fd;
    color: #6e42f5;
}

.status-kembali {
    background: #EDEDED; color: #666666;
}

.status-batal {
    background-color: #ffe1e1;
    color: #d93025;
}

        .aksi:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        $('.editModal').click(function () {

            var user = $(this).data('user');
            var kendaraan = $(this).data('kendaraan');
            var pinjam = $(this).data('pinjam');
            var harus_kembali = $(this).data('harus_kembali');
            var kembali = $(this).data('kembali');
            var status = $(this).data('status');
            var id = $(this).data('id');


          $('#pinjam_id').val(id);
          $('#peminjaman').text(`Edit peminjaman ${user} : ${kendaraan}`);
          $('#tgl_pinjamEdit').val(pinjam);
          $('#tgl_harus_kembaliEdit').val(harus_kembali);
          $('#tgl_kembaliEdit').val(kembali);
          $('#statusEdit').val(status);

        });

        $('#infoerror').fadeIn(1000).delay(10000).fadeOut(1000);
  
    </script>
</x-layout>
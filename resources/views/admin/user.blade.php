<x-layout>
    <x-slot:title>Management User</x-slot:title>


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
        <h4>Management User</h4>
        <div class="mt-3 bg-white p-2 rounded shadow">
            <div class="d-flex justify-content-between mb-3 mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahUser">Tambah</button>
                <form action="/admin/user/search/" method="get" style="width:200px;">
                    <input type="search" name="search" id="" placeholder="Cari user" class="form-control"
                        autocomplete="off">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th width="1%">No</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $no => $u)
                            <tr>
                                <th class="text-nowrap">{{ $no + 1 }}</th>
                                <td class="text-nowrap">{{ ucwords($u->user_nama) }}</td>
                                <td class="text-nowrap">{{ $u->user_alamat }}</td>
                                <td class="text-nowrap">{{ $u->username }}</td>
                                <td class="text-nowrap">*******</td>
                                <td class="text-nowrap">
                                    @if ($u->user_status == 'admin')
                                        <span class="status-admin">{{ ucfirst($u->user_status) }}</span>
                                    @else
                                        <span class="status-user">{{ ucfirst($u->user_status) }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap d-flex gap-2">
                                    <!-- ----- button edit ------ -->
                                    <a href="#" class="editModal aksi text-primary" data-user-id="{{ $u->user_id }}"
                                        data-user-nama="{{ $u->user_nama }}" data-username="{{ $u->username }}"
                                        data-user-alamat="{{ $u->user_alamat }}"
                                        data-user-status="{{ $u->user_status }}" data-bs-toggle="modal"
                                        data-bs-target="#editUser">
                                            <i class="ri-edit-2-fill"></i>
                                    </a>

                                    <!-- ------- button hapus -------- -->
                                    <a href="{{ route('admin.user.destroy', $u->user_id) }}" data-confirm-delete="true"
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
                {{ $user->links() }}
            </div>
        </div>
    </div>

    <!-------------------------------------- modal untuk tambah data ------------------------------------------->

    <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="userTambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/user/store" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="masukan username" autocomplete="off" required>
                            <label for="username">Buat Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="masukan nama"
                                autocomplete="off" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                placeholder="masukan alamat" autocomplete="off" required>
                            <label for="alamat">Alamat Lengkap</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukan Password" required>
                            <label for="password">Buat Password</label>
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

    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="userEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="/admin/user/update" method="post">
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-floating mb-4">
                            <input type="text" name="username" class="form-control" id="editUsername"
                                placeholder="masukan username" autocomplete="off" required>
                            <label for="username">Edit Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="editNama" placeholder="masukan nama"
                                autocomplete="off" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="alamat" class="form-control" id="editAlamat"
                                placeholder="masukan alamat" autocomplete="off" required>
                            <label for="alamat">Alamat Lengkap</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="editPassword" class="form-control"
                                placeholder="Masukan Password">
                            <label for="password">Ganti Password</label>
                        </div>

                        <div class="form-group mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option>Pilih status</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <p>Pergantian <b>status</b> dapat membuat perubahan <b>hak akses!</b></p>
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
            width: 70px;
            text-align: center;
            border-radius: 4px;
        }

        .status-admin {
            background-color: #ffe0b2;
            color: #e65100;
        }

        .status-user {
            background-color: #d7e8ff;
            color: #2f74c0;
        }

        .aksi:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        $('.editModal').click(function () {
            var id = $(this).data('user-id');
            var nama = $(this).data('user-nama');
            var username = $(this).data('username');
            var alamat = $(this).data('user-alamat');
            var status = $(this).data('user-status');

            // disini password tidak saya masukan karena itu berupa hash yang sangat panjang
            $('#user_id').val(id);
            $('#editUsername').val(username);
            $('#editNama').val(nama);
            $('#editAlamat').val(alamat);
            $('#editStatus').val(status);

        });

        $('#infoerror').fadeIn(1000).delay(10000).fadeOut(1000);
  
    </script>
</x-layout>
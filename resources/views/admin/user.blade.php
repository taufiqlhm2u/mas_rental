<x-layout>
    <x-slot:title>User</x-slot:title>
    <div class="p-3">
        <h4>User</h4>
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
                                    <a href="" class="aksi"><button class="btn btn-warning d-flex justify-content-center" style="color:#F5F5F0; width: 30px; height: 30px; font-size: 12px;">
                                        <i class="ri-edit-fill"></i>
                                    </button></a>
                                    <a href="{{ route('admin.user.destroy', $u->user_id) }}" data-confirm-delete="true" class="aksi"><button class="btn btn-danger d-flex justify-content-center" style="color:#F5F5F0; width: 30px; height: 30px; font-size: 12px;">
                                       <i class="ri-close-circle-fill"></i>
                                    </button></a>
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

    <!-- modal untuk tambah data -->

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
                                placeholder="masukan username" autocomplete="off">
                            <label for="username">Buat Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="masukan nama"
                                autocomplete="off">
                            <label for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                placeholder="masukan alamat" autocomplete="off">
                            <label for="alamat">Alamat Lengkap</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukan Password">
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
</x-layout>
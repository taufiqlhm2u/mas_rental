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
              

            </div>

            <div class="section">
                <h4 class="mb-3 fw-bold">Rental Saya</h4>


            </div>


        </div>
    </div>

</x-layout>
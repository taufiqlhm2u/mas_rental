<!-- modal profile -->
<div class="modal fade " id="modalProfile" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-tile fs-5">Ubah Profile</h1>
            </div>
            <form action="/profile/update" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="nama" id="nama" placeholder="nama" class="form-control"
                            value="{{ auth()->user()->user_nama }}">
                        <label for="nama">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" id="username" placeholder="username" class="form-control"
                            value="{{ auth()->user()->username }}">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="alamat" id="alamat" placeholder="alamat" class="form-control"
                            value="{{ auth()->user()->user_alamat }}">
                        <label for="alamat">alamat</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal ganti password -->
<div class="modal fade " id="modalPw" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-tile fs-5">Ganti Password</h1>
            </div>
            <form action="/password/change" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" name="oldpass" id="oldpass" class="form-control"
                            placeholder="Masukan password lama" required>
                        <label for="oldpass">Password lama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="newpass" id="newpass" class="form-control"
                            placeholder="Masukan password baru" required>
                        <label for="newpass">Password baru</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
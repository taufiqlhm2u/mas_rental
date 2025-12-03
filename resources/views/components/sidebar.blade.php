<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex justify-content-between p-4">
            <div class="sidebar-logo">
                <a href="/admin/dashboard">Masrental</a>
            </div>
            <button class="toggle-btn border-0" type="button">
                <i id="icon" class="ri-arrow-right-double-fill"></i>
            </button>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="/admin/dashboard" class="sidebar-link">
                    <i class="ri-home-5-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item overflow-hidden">
                <a href="/admin/user" class="sidebar-link">
                    <i class="ri-group-line"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/admin/kendaraan" class="sidebar-link">
                    <i class="ri-car-line"></i>
                    <span>kendaraan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/admin/pinjam" class="sidebar-link">
                    <i class="ri-p2p-fill"></i>
                    <span>Peminjaman</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a onclick="logOut()" class="sidebar-link text-danger">
                <i class="ri-logout-box-line"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main" class="p-3">

        <div id="keluar">
            <div class="konfir">
                <div class="ask">
                    <span>Apakah kamu ingin keluar?</span>
                </div>
                <div class="konfir-option">
                    <button class="cancel btn btn-secondary" class="text-secondary">cancel</button>
                    <a href="/logout">
                        <button id="logOut" class="btn btn-danger">Log Out</button>
                    </a>
                </div>
            </div>
        </div>
        <header class="px-4 d-flex justify-content-end align-items-center flex-shrink-0" id="header">
            Hello &nbsp;<b>{{ Auth::user()->user_nama }}</b>
        </header>

        {{ $slot }}

        <footer class="mt-5">
            <p class="text-secondary">&copy;2025 masrental</p>
        </footer>
    </div>
</div>
<script>
    function logOut() {
        $('#keluar').css({
            'display': 'flex',
            'justify-content': 'center',
            'align-items': 'center'
        })
    }

    $('.cancel').click(function () {
        $('.account').fadeOut();
        $('#keluar').fadeOut();
    })
</script>
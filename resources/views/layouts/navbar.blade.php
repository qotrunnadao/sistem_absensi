<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-logout">Logout</button>
            </form>
        </li>
    </ul>

</nav>
<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title"><i class="fas fa-sign-out-alt"></i> Keluar Aplikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center;">Apakah anda yakin untuk keluar aplikasi?</p>
                <div class="col text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary text-center"><i class="fas fa-sign-out-alt"></i> Ya. Keluar Aplikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.navbar -->

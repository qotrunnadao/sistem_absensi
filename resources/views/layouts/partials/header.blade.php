<nav class="main-header navbar navbar-expand navbar-dark navbar-secondary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- /.left navbar links -->

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
        <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modal-logout">
            Logout
        </button>
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


                        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); this.closest('form').submit();"> <i class="fas fa-sign-out-alt"></i>Logout</a>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

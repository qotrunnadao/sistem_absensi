<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Logo -->
    <a href="jenderalcorp.com" class="brand-link navbar-dark">
        <img src="{{ asset('adminlte/dist/img/logoJenderal.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Jenderal Software</span>
    </a>
    <!-- /.logo -->

    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- /.user panel -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">


            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->segment(1) == 'dashboard' ? "active" :'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->segment(1) == 'user' ? "active" :'' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            user
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Data Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('absensi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absensi Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('izin.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Karyawan Izin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Atur Waktu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jam Kerja</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('libur.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hari Libur</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
</aside>

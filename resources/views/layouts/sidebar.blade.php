<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/unnamed.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Jenderal Software</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" src="https://png.pngtree.com/png-vector/20191009/ourmid/pngtree-user-icon-png-image_1796659.jpg" alt="{{ Auth::user()->name }}" />

            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->name }}</a>
                <span class="badge badge-success">{{ Auth::user()->level == 0 ? 'Admin' : 'Karyawan' }}</span>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="<?= url('') ?>/dashboard" class="nav-link {{ active_menu(1,'dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ active_menu(1,'user') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=url('')?>/libur" class="nav-link {{ active_menu(1,'libur') }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Atur Hari Libur</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ menu_open(1,'absensi') }}  {{ menu_open(1,'izin') }} {{ menu_open(1, 'pengajuan') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=url('')?>/absensi" class="nav-link {{ active_menu(1,'absensi') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Absensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('')?>/izin" class="nav-link {{ active_menu(1,'izin') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Izin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?=url('') ?>/absensi/kamera" class="nav-link {{ active_menu(1,'kamera') }}">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Kamera</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=url('') ?>/absensi/formcetak" class="nav-link {{ active_menu(1,'kamera') }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>Cetak Laporan</p>
                    </a>
                </li>

                {{-- End Dashboard --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

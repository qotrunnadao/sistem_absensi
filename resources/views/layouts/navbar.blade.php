<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-secondary">
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
                <button class="btn btn-default" type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

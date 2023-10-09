<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-quote-left"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FPBS UPI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


@if(auth()->check() && auth()->user()->role === 'admin')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Daftar Permohonan -->
    <li class="nav-item {{ request()->is('daftar-permohonan') ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Daftar Permohonan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Jadwal Ruangan -->
    <li class="nav-item {{ request()->is('admin/jadwal') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.jadwal') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Jadwal Ruangan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Manajemen Ruang -->
    <li class="nav-item {{ request()->is('admin/room') || request()->is('admin/room/create') || request()->is('admin/room/*/edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('room.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen Ruang</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Manajemen User -->
    <li class="nav-item {{ (request()->is('admin/users*') && !request()->has('keyword')) || request()->is('admin/users/search*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen User</span>
        </a>
    </li>
@endif


@if(auth()->check() && auth()->user()->role === 'user')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
@endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

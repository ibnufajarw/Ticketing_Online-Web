<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('landing-page.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">EasyIN</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Data Acara
    </div>
    <li class="nav-item {{ request()->is('dashboard/acara') || request()->is('dashboard/acara/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.acara.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Acara</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaksi.index') }}">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Penjualan Tiket</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pembelian.index') }}">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Pembelian Tiket</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

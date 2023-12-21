<style>
    .navbar {
        z-index: 999 !important;
    }
</style>
<nav
    class="navbar navbar-expand-lg navbar-dark {{ request()->is('login') || request()->is('register') || !request()->is('/') ? 'bg-white border-bottom' : '' }}">
    <div class="container">
        <a class="navbar-brand {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} text-title"
            href="{{ route('landing-page.index') }}">EasyIN</a>
        
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ms-3">
                    <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                        aria-current="page" href="{{ route('landing-page.index') }}">Home</a>
                </li>
                @if (auth()->user() && auth()->user()->role == 'user')
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                            aria-current="page" href="{{ route('dashboard.acara.create') }}">Buat Kegiatan</a>
                    </li>
                @endif
                @if (auth()->user())
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                            href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                            href="#" onclick="document.getElementById('form-logout').submit();">Logout <i
                                class="fa-solid fa-power-off"></i></a>
                        <form action="{{ route('logout') }}" method="POST" id="form-logout">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                            href="{{ route('register') }}">Daftar</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->is('login') || request()->is('register') || !request()->is('/') ? '' : 'text-white' }} fs-14"
                            href="{{ route('login') }}">Masuk</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

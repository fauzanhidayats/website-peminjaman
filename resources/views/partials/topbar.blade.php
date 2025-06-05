<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- Foto Profil User --}}
                <img alt="image"
                    src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1" />
                {{-- Nama User --}}
                <div class="d-sm-none d-lg-inline-block">
                    Hi, {{ Auth::user()->username }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- Link Profile sesuai Role --}}
                @php
                    $role = Auth::user()->role->nama_role;
                    $profileRoute = '#';

                    if ($role === 'admin') {
                        $profileRoute = route('admin.profile');
                    } elseif ($role === 'peminjam') {
                        $profileRoute = route('peminjam.profile');
                    } elseif ($role === 'pimpinan') {
                        $profileRoute = route('pimpinan.profile');
                    }
                @endphp

                <a href="{{ $profileRoute }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <div class="dropdown-divider"></div>

                {{-- Logout Form --}}
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center"
                        style="cursor: pointer;">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </li>
    </ul>

</nav>

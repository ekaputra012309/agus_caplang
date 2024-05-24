<aside class="main-sidebar sidebar-light-teal elevation-4">

    <a href="{{ route('dashboard') }}" class="brand-link">
        {{-- <img src="{{ asset('backend/img/logofullasa.png') }}" alt="AdminLTE Logo" style="width: 150px;"> --}}
        <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <br>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (in_array(auth()->user()->role, ['Admin']))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('karyawan.index') }}" class="nav-link">
                                    <i class="fas fa-circle-notch nav-icon"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('hubkaryawan.index') }}" class="nav-link">
                                    <i class="fas fa-circle-notch nav-icon"></i>
                                    <p>Hub Karyawan</p>
                                </a>
                            </li>
                            @if (in_array(auth()->user()->role, ['Admin']))
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-feather-alt"></i>
                        <p>
                            Request User
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>

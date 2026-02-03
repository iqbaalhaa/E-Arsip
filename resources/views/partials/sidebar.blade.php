<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard Admin</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Admin Menu</span></li>

                    <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('users.index') }}"
                            aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                class="hide-menu">Manajemen User</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('institution-profiles.index') }}"
                            aria-expanded="false"><i data-feather="info" class="feather-icon"></i><span
                                class="hide-menu">Profil Instansi</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('categories.index') }}"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">Kategori Arsip</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('archives.index') }}"
                            aria-expanded="false"><i data-feather="archive" class="feather-icon"></i><span
                                class="hide-menu">Manajemen Arsip</span></a>
                    </li>
                    {{-- <li class="sidebar-item"> <a class="sidebar-link" href="#" aria-expanded="false"><i
                                data-feather="database" class="feather-icon"></i><span class="hide-menu">Manajemen
                                Database</span></a>
                    </li> --}}
                    <li class="sidebar-item"> <a class="sidebar-link" href="{{ url('view-report') }}"
                            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                class="hide-menu">Laporan</span></a>
                    </li>
                @elseif(Auth::check() && Auth::user()->role === 'pegawai')
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="{{ route('pegawai.dashboard') }}" aria-expanded="false"><i data-feather="home"
                                class="feather-icon"></i><span class="hide-menu">Dashboard Pegawai</span></a></li>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Pegawai Menu</span></li>

                    <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('archives.index') }}"
                            aria-expanded="false"><i data-feather="archive" class="feather-icon"></i><span
                                class="hide-menu">Manajemen Arsip</span></a>
                    </li>
                @endif
                {{-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ url('/') }}"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li> --}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

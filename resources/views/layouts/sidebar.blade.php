<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="fas fa-power-off"></i>
                                <span class="hide-menu"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(auth()->guard('web')->check())
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} active" href="{{ url('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.index') ? 'active' : '' }} active" href="{{ route('pedagang.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet"></i>
                            <span class="hide-menu">Pedagang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('users.index') ? 'active' : '' }} active" href="{{ route('users.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-travel"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('kategori.index') ? 'active' : '' }} active" href="{{ route('kategori.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pemasukan.index') ? 'active' : '' }} active" href="{{ route('pemasukan.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Pemasukan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pengeluaran.index') ? 'active' : '' }} active" href="{{ route('pengeluaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('kwitansi.index') ? 'active' : '' }} active" href="{{ route('kwitansi.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Kwitansi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.tagihans.index') ? 'active' : '' }} active" href="{{ route('admin.tagihans.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-giftcard"></i>
                            <span class="hide-menu">Tagihan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pembayaran.index') ? 'active' : '' }} active" href="{{ route('pembayaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pemasukan.laporan') ? 'active' : '' }} active" href="{{ route('pemasukan.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Laporan Pemasukan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pengeluaran.laporan') ? 'active' : '' }} active" href="{{ route('pengeluaran.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Laporan Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.tempats.index') ? 'active' : '' }} active" href="{{ route('admin.tempats.index') }}" aria-expanded="false">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Tempat</span>
                        </a>
                    </li>
                @else
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} active" href="{{ url('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pembayaran.index') ? 'active' : '' }} active" href="{{ route('pedagang.pembayaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pengeluaran') ? 'active' : '' }} active" href="{{ route('pedagang.pengeluaran') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-travel"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('tagihans.index') ? 'active' : '' }} active" href="{{ route('tagihans.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-giftcard"></i>
                            <span class="hide-menu">Tagihan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

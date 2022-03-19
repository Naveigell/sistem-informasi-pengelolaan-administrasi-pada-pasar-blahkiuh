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
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.index') ? 'active' : '' }}" href="{{ route('pedagang.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet"></i>
                            <span class="hide-menu">Pedagang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-travel"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-cart-outline"></i>
                            <span class="hide-menu">Pemasukan</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @foreach($categories as $category)
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.kategori.pemasukan.index', $category) }}" class="sidebar-link">
                                        <i class="mdi mdi-cards-variant"></i>
                                        <span class="hide-menu">{{ ucwords($category->nama_kategori) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pengeluaran.index') ? 'active' : '' }}" href="{{ route('pengeluaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('kwitansi.index') ? 'active' : '' }}" href="{{ route('kwitansi.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Kwitansi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.tagihans.index') ? 'active' : '' }}" href="{{ route('admin.tagihans.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-giftcard"></i>
                            <span class="hide-menu">Tagihan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pembayaran.index') ? 'active' : '' }}" href="{{ route('pembayaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pemasukan.laporan') ? 'active' : '' }}" href="{{ route('pemasukan.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Laporan Pemasukan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pengeluaran.laporan') ? 'active' : '' }}" href="{{ route('pengeluaran.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Laporan Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.tempats.index') ? 'active' : '' }}" href="{{ route('admin.tempats.index') }}" aria-expanded="false">
                            <i class="mdi mdi-map"></i>
                            <span class="hide-menu">Tempat</span>
                        </a>
                    </li>
                @else
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pembayaran.index') ? 'active' : '' }}" href="{{ route('pedagang.pembayaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pengeluaran') ? 'active' : '' }}" href="{{ route('pedagang.pengeluaran') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet-travel"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('tagihans.index') ? 'active' : '' }}" href="{{ route('tagihans.index') }}" aria-expanded="false">
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

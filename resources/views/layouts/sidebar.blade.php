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
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.pedagang.index') ? 'active' : '' }}" href="{{ route('admin.pedagang.index') }}" aria-expanded="false">
                            <i class="fa fa-handshake"></i>
                            <span class="hide-menu">Pedagang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.kategori.index') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}" aria-expanded="false">
                            <i class="mdi mdi-paper-cut-vertical"></i>
                            <span class="hide-menu">Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-download"></i>
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
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.pengeluaran.index') ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-upload"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.kwitansi.index') ? 'active' : '' }}" href="{{ route('admin.kwitansi.index') }}" aria-expanded="false">
                            <i class="fa fa-paperclip"></i>
                            <span class="hide-menu">Kwitansi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.tagihans.index') ? 'active' : '' }}" href="{{ route('admin.tagihans.index') }}" aria-expanded="false">
                            <i class="fa fa-money-bill-alt"></i>
                            <span class="hide-menu">Tagihan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.pembayaran.index') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}" aria-expanded="false">
                            <i class="fa fa-hand-holding"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.pemasukan.laporan') ? 'active' : '' }}" href="{{ route('admin.pemasukan.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-book-plus"></i>
                            <span class="hide-menu">Laporan Pemasukan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('admin.pengeluaran.laporan') ? 'active' : '' }}" href="{{ route('admin.pengeluaran.laporan') }}" aria-expanded="false">
                            <i class="mdi mdi-book-minus"></i>
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
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.dashboard') ? 'active' : '' }}" href="{{ route('pedagang.dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <div class="devider"></div>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pembayaran.index') ? 'active' : '' }}" href="{{ route('pedagang.pembayaran.index') }}" aria-expanded="false">
                            <i class="fa fa-hand-holding"></i>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.pengeluaran.index') ? 'active' : '' }}" href="{{ route('pedagang.pengeluaran.index') }}" aria-expanded="false">
                            <i class="mdi mdi-upload"></i>
                            <span class="hide-menu">Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('pedagang.tagihans.index') ? 'active' : '' }}" href="{{ route('pedagang.tagihans.index') }}" aria-expanded="false">
                            <i class="fa fa-money-bill-alt"></i>
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

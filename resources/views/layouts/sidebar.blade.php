<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">RAM Water</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="{{ asset('assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div> --}}
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link {{ request()->is('ops*') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt    "></i>
                            <p class="text">Dashboard</p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Mastering</li>
                    <div class="dropdown-divider"></div>

                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}"
                            class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            <p class="text">Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}"
                            class="nav-link {{ request()->is('produk*') ? 'active' : '' }}">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                            <p class="text">Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hargajenis.index') }}"
                            class="nav-link {{ request()->is('hargajenis*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill    "></i>
                            <p class="text">Harga jenis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('konsumen.index') }}"
                            class="nav-link {{ request()->is('konsumen*') ? 'active' : '' }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p class="text">Data Konsumen</p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Pembelian</li>
                    <div class="dropdown-divider"></div>

                    <li class="nav-item">
                        <a href="{{ route('pembelian.index') }}"
                            class="nav-link {{ request()->is('pembelian*') ? 'active' : '' }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <p class="text">Daftar Pembelian</p>
                        </a>
                    <li class="nav-item">
                        <a href="{{ route('retur.index') }}"
                            class="nav-link {{ request()->is('retur*') ? 'active' : '' }}">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            <p class="text">Retur Produk</p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Penjualan</li>
                    <div class="dropdown-divider"></div>

                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}"
                            class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <p class="text">Daftar Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pembayaran.index') }}"
                            class="nav-link {{ request()->is('pembayaran*') ? 'active' : '' }}">
                            <i class="fas fa-cart-arrow-down    "></i>
                            <p class="text">Pembayaran Tempo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('galon.index') }}" class="nav-link {{ request()->is('galon*') ? 'active' : '' }}">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                            <p class="text">Transaksi Galon</p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Tool</li>
                    <div class="dropdown-divider"></div>

                    <li class="nav-item">
                        <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave    "></i>
                            <p class="text">Oprasional</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->is('#*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave    "></i>
                            <p class="text">Stok Opname</p>
                        </a>
                    </li> --}}

                    @if (Auth::user()->jabatan=="99")     
                    <div class="dropdown-divider"></div>
                    <li class="nav-header">Office Setting</li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fa fa-user-circle" aria-hidden="true" m-2></i>
                            <p class="text">User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is('jabatan*') ? 'active' : '' }}">
                            <i class="fa fa-signal" aria-hidden="true"></i>
                            <p class="text">Jabatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->is('karyawan*') ? 'active' : '' }}">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                            <p class="text">Karyawan</p>
                        </a>
                    </li>
                    @endif

                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->is('ops*') ? 'active' : '' }}">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <p class="text">Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->is('ops*') ? 'active' : '' }}">
                            <i class="fa fa-id-badge" aria-hidden="true"></i>
                            <p class="text">Profil</p>
                        </a>
                    </li> --}}

                    <div class="dropdown-divider mt-5"></div>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

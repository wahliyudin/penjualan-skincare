<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#dashboard">
                <i class="zmdi zmdi-home"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="{{ route('home') }}">{{ auth()->user()->name }}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image">
                                <a href="profile.html">
                                    <img src="assets/images/profile_av.jpg" alt="User">
                                </a>
                            </div>
                            <div class="detail">
                                <h4>{{ auth()->user()->name }}</h4>
                            </div>
                        </div>
                    </li>
                    <li class="header">MAIN</li>
                    <li class="{{ request()->routeIs('home') ? 'active open' : '' }}">
                        <a href="{{ route('home') }}">
                            <i class="zmdi zmdi-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li
                        class="{{ request()->routeIs('master.admin', 'master.customer', 'master.supplier', 'master.product') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-lock"></i>
                            <span>Master</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ request()->routeIs('master.admin') ? 'active' : '' }}">
                                <a href="{{ route('master.admin') }}">
                                    <span>Admin</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('master.customer') ? 'active' : '' }}">
                                <a href="{{ route('master.customer') }}">
                                    <span>Pelanggan</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('master.supplier') ? 'active' : '' }}">
                                <a href="{{ route('master.supplier') }}">
                                    <span>Pemasok</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('master.product') ? 'active' : '' }}">
                                <a href="{{ route('master.product') }}">
                                    <span>Barang</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('sale') ? 'active open' : '' }}">
                        <a href="{{ route('sale') }}">
                            <i class="zmdi zmdi-accounts-alt"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('transaction') ? 'active open' : '' }}">
                        <a href="{{ route('transaction') }}">
                            <i class="zmdi zmdi-accounts-alt"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-lock"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a target="_blank" href="{{ route('report.admin.pdf') }}">
                                    <span>Data Admin</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('report.customer.pdf') }}">
                                    <span>Data Pelanggan</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('report.product.pdf') }}">
                                    <span>Data Barang</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('report.sale') }}">
                                    <span>Data Penjualan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-pane stretchLeft" id="user">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info m-b-20 p-b-15">
                            <div class="image">
                                <a href="profile.html">
                                    <img src="{{ asset('assets/images/profile_av.jpg') }}" alt="User">
                                </a>
                            </div>
                            <div class="detail">
                                <h4>{{ auth()->user()->name }}</h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

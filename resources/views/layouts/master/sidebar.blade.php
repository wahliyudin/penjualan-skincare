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
                    <li class="{{ request()->routeIs('admin') ? 'active open' : '' }}">
                        <a href="{{ route('admin') }}">
                            <i class="zmdi zmdi-account"></i>
                            <span>Admin</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('customer') ? 'active open' : '' }}">
                        <a href="{{ route('customer') }}">
                            <i class="zmdi zmdi-accounts-alt"></i>
                            <span>Pelanggan</span>
                        </a>
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


<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{url('images/logo/logo.jpeg')}}" style="height: 40px;width:40px;" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{Auth::guard(session()->get('role'))->user()->username}}</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
        <a href="{{route('user.dashboard.index')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Dashboard
            </p>
        </a>
        </li>
        
        <li class="nav-item">
            <a href="{{route('user.peminjaman.index')}}" class="nav-link {{ request()->is('user/peminjaman*') ? 'active' : '' }}">
              <i class="nav-icon ion ion-bag"></i>
              <p>
                  Transaksi
              </p>
            </a>
        </li>
        <li class="nav-item bg-light">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                  Keluar
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
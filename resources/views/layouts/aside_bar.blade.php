<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="/dist/img/1552904276179.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- SidebarSearch Form -->
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

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Pakaian
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('produk.kategori.gender', ['kategori' => 'pakaian', 'gender' => 'pria']) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pakaian Laki-laki</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('produk.kategori.gender', ['kategori' => 'pakaian', 'gender' => 'perempuan']) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pakaian Perempuan</p>
              </a>
            </li>
          </ul>
        </li><li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Sepatu
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('produk.kategori.gender', ['kategori' => 'sepatu', 'gender' => 'pria']) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sepatu Laki-laki</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('produk.kategori.gender', ['kategori' => 'sepatu', 'gender' => 'perempuan']) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sepatu Perempuan</p>
              </a>
            </li>
          </ul>
        </li>
        @if(!is_null(Auth::user()))
          <li class="nav-item">
            <a href="{{ route('produk.addcart.po') }}" class="nav-link">
                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                <span>Cart</span>
              </a>
          </li>
        
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">
                <i class="ni ni-user-run"></i>
                <span>Login</span>
              </a>
          </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
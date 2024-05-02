    <style>
      .active {
        background-color: #D9D9D9 !important;
        color: black !important;
      }

      .active p {
        color: black;
      }

      .active i {
        color: black;
      }

      .nav-item p {
        color: black;
      }

      .nav-item i {
        color: black;
      }
    </style>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-3 mb-5 d-block">
        <div class="d-flex justify-content-center">
          <div class="rounded-pill bg-light text-center" style="width: 100px">
            <span style="color: black; font-size: 20px" class="font-italic p-1">User</span>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')?'active' : '' }} ">
              <i class="nav-icon fas fa-house-user"></i>
              <p>Dashboard</p>
            </a>
            {{-- @if (auth()->user()->level_id==2) --}}
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'peminjaman')?'active' : '' }}">
                  <i class="fas fa-book-reader nav-icon"></i>
                  <p>Transaksi Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'pengembalian')?'active' : '' }}">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Transaksi Pengembalian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'history')?'active' : '' }}">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Cek History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'denda')?'active' : '' }}">
                  <i class="fas fa-wallet nav-icon"></i>
                  <p>Cek Denda</p>
                </a>
              </li>
            {{-- @endif
            @if (auth()->user()->level_id==1) --}}
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'level')?'active' : '' }}">
                  <i class="fas fa-layer-group nav-icon"></i>
                  <p>Data Level</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'user')?'active' : '' }}">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'buku')?'active' : '' }}">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Data Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link {{ ($activeMenu == 'transaksi')?'active' : '' }}">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Transaksi</p>
                </a>
              </li>
            {{-- @endif --}}
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

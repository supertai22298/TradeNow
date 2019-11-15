  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admins/index3.html" class="brand-link elevation-4">
      <img src="admins/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">TradeNow</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="admins/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Nguyễn Văn Tài</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header pt-2 user-panel">SẢN PHẨM</li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link" id="nav-categories">
              <i class="fa-fw fas fa-folder-open"></i>
              <p>Danh mục</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-gift"></i>
              <p>Khuyến mãi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.brands.index') }}" class="nav-link" id="nav-brands">
              <i class="fa-fw fas fa-copyright"></i>
              <p>Thương hiệu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-unlock-alt"></i>
              <p>Kiểm duyệt sản phẩm</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-comments"></i>
              <p>Bình luận</p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>
                Sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="fas fa-bars"></i>
                  <p>Tất cả sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-gifts"></i>
                  <p>Sản phẩm khuyến mãi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-ban"></i>
                  <p>Sản phẩm vi phạm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-comment-dots"></i>
                  <p>Trả lời bình luận</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          {{--  --}}
          <li class="nav-header pt-2 user-panel">ĐƠN HÀNG</li>
          <li class="nav-item has-treeview menu-open ">
            <a href="#" class="nav-link active">
              <i class="fas fa-shopping-cart"></i>
              <p>
                Đơn hàng của tôi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="fas fa-bars"></i>
                  <p>Tất cả </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Đơn hàng đổi trả</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-republican"></i>
                  <p>Quản lý nhận xét</p>
                </a>
              </li>
              
            </ul>
          </li>
          {{--  --}}
          <li class="nav-header pt-2 user-panel">Dữ liệu</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-chart-pie"></i>
              <p>Phân tích sản phẩm</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-chart-line"></i>
              <p>Phân tích người dùng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-chart-bar"></i>
              <p>Thống kê chi tiết</p>
            </a>
          </li>

          <li class="nav-header pt-2 user-panel">NGƯỜI DÙNG</li>
          <li class="nav-item">
            <a href="{{route('admin.users.index')}}" class="nav-link">
              <i class="fas fa-address-book"></i> 
              <p>Khách hàng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-handshake"></i>
              <p>Nhà cung cấp</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.contacts.index') }}" class="nav-link">
              <i class="fa-fw fas fa-file-contract"></i>
              <p>Liên hệ</p>
            </a>
          </li>
        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
 <!-- /Main Sidebar Container -->
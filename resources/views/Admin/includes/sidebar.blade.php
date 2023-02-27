<aside class="main-sidebar elevation-4 sidebar-dark-maroon">
    <a href="{{route('dashboard')}}" class="brand-link text-center ">
      <div class="bounce">
        <b>
        <span id="website_logo_text_header" style="font-size:14px; font-weight: bold; color:#ffff">Admin Panel</span>

        </b>
      </div>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open-new menu-open">
            <a href="{{route('dashboard')}}/" class="nav-link ">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                 Tổng Quan
              </p>
            </a>
          </li>
          <li class="nav-item menu-open-new">
            <a href="{{route('services')}}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>Dịch Vụ </p>
              <span class="badge badge-success right countPending" >{{countServices()}}</span>
            </a>
          </li>

          <li class="nav-item has-treeview menu-open menu-open-new">
            <a href="{{route('projects')}}" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon far fa-file-alt"></i>
              <p>Dự án <i class="fas fa-angle-left right"></i></p>
              
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="{{route('projects')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tất cả</p>
                  <span class="badge badge-info right countBlock" ></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('projects_expired')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Còn Hạn</p>
                  <span class="badge badge-success right countPending" >{{countProjectsExpired()}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('projects_unexpired')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hết Hạn</p>
                  <span class="badge badge-danger right countPending" >{{countProjectsUnexpired()}}</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open menu-open-new">
            <a  class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon far fa-newspaper"></i>
              <p>Tin tức <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview menu-open menu-open-new">
              <li class="nav-item">
                <a href="{{route('admin.news.dashboard')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài viết</p>
                  <span class="badge badge-info right countBlock" >{{countNews()}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.categories.dashboard')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục</p>
                  <span class="badge badge-success right countPending" >{{countCategories()}}</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu-open-new">
            <a href="{{route('pages')}}" class="nav-link">
              <i class="nav-icon fas fa-pager"></i>
              <p>Quản Lý Trang</p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-open-new">
            <a href="{{route('users')}}" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                  Khách hàng
              </p>
              <span class="badge badge-success right countPending" >{{countUser()}}</span>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="{{route('contact')}}" class="nav-link ">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                  Liên hệ
              </p>
            </a>
            
          </li>

          <li class="nav-item has-treeview menu-open-new">
            <a href="{{route('settings')}}" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                  Cài đặt
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-open-new">
            <a href="{{route('profile_admin')}}" class="nav-link ">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                  Hồ sơ admin
              </p>
            </a>
          </li>

          <li class="nav-item menu-open-new">
            <a href="{{route('logout-admin')}}" class="nav-link ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Đăng Xuất
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

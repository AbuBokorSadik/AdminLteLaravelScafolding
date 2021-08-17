<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/admin" class="nav-link">
            <p>
              Dashboard
              <span class="badge badge-info right"></span>
            </p>

          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <p>
              MANAGE AGENT
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('agents.index') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Agent List</p>
              </a>
            </li>
          </ul>
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('agents.create') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Add Agent</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <p>
              CATEGORY
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Category List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories.create') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Add Category</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <p>
              PRODUCT
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('products.index') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Product List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('products.create') }}" class="nav-link">
                <i class="fab fa-blackberry"></i>
                <p>Add Product</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
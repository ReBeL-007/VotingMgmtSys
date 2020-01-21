
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('public/backend/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ url('admin')}}" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ url('admin')}}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              
            </p>
          </a>
        </li>
        
        
        {{-- <li class="nav-item">
          <a href="{{route('organization.index')}}" class="nav-link">
            <i class="nav-icon far fa-building"></i>
            <p>
              Manage Organization
            </p>
          </a>
        </li> --}}

        {{-- <li class="nav-item">
          <a href="{{route('position.index')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Manage Position
            </p>
          </a>
        </li> --}}

        <li class="nav-item">
          <a href="{{route('candidate.index')}}" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>
              Manage Candidate
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('voterslist.index')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Manage Voters List
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('voterslist.import-export')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Import Voters List
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('candidate.import-export')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Import Candidates
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
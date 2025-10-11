    <header class="header">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="{{ url('home') }}" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">MS</strong><strong>BS</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">MS</strong><strong>BS</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">
            <div class="list-inline-item"><a href="#" class="search-open nav-link"></a></div>

            <!-- Log out               -->

            <div class="list-inline-item logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="padding:0; color:inherit;">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>
            </div>
          </div>
        </div>
      </nav>
    </header>

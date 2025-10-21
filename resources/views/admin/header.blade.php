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

            @auth
                <div class="list-inline-item logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="padding: 3px; margin: 2px; background-color:red; color:white;">
                            <i class="fa fa-sign-out"></i> Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="list-inline-item login">
                    <form method="GET" action="{{ route('login') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link login-button" style="padding: 3px; margin: 2px; background-color:green; color:white;">
                            <i class="fa fa-sign-in"></i> Login
                        </button>
                    </form>
                </div>

                <div class="list-inline-item register">
                    <form method="GET" action="{{ route('register') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link register-button" style="padding: 3px; margin: 2px; background-color:blue; color:white;">
                            <i class="fa fa-user-plus"></i> Register
                        </button>
                    </form>
                </div>
            @endauth
          </div>
        </div>
      </nav>
    </header>

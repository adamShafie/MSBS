<header class="header">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <!-- LEFT: Logo + Sidebar Toggle -->
      <div class="d-flex align-items-center gap-3">
        <a href="{{ url('home') }}" class="navbar-brand d-flex align-items-center">
          <img src="{{ asset('images/MSBS-logo.png') }}"
               alt="MSBS Logo"
               class="brand-logo">
        </a>

        <button class="sidebar-toggle" aria-label="Toggle Sidebar">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- RIGHT: Auth Buttons -->
      <div class="right-menu d-flex align-items-center gap-2">

        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1" style="color: white; background-color: #ec0505ff; border-color: grey;">
              <i class="fa fa-sign-out"></i>
              <span class="d-none d-md-inline">Logout</span>
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-success btn-sm d-flex align-items-center gap-1 " style="color: white; background-color: #00720dff; border-color: grey; margin-right: 5px;">
            <i class="fa fa-sign-in"></i>
            <span class="d-none d-md-inline">Login</span>
          </a>

          <a href="{{ route('register') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="color: white; background-color: #0044cc; border-color: grey;">
            <i class="fa fa-user-plus"></i>
            <span class="d-none d-md-inline">Register</span>
          </a>
        @endauth

      </div>

    </div>
  </nav>
</header>

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ url('/')}}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>CarServ</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/')}}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="{{ url('service_booking')}}" class="dropdown-item">Booking</a>
                        <a href="#" class="dropdown-item">Inspection Tips</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="{{ url('user_profile')}}" class="nav-item nav-link">Profile</a>


                @if (Route::has('login'))
                        @auth
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ url('login') }}" class="btn btn-success py-4 px-lg-5 d-none d-lg-block">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ url('register') }}" class="btn btn-secondary py-4 px-lg-5 d-none d-lg-block">Register</a>
                            @endif
                        @endauth
                @endif

            </div>
        </div>
    </nav>

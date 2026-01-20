<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Carousel image styling */
        .carousel-item img {
            height: 400px;          /* fixed banner height */
            object-fit: cover;      /* crop instead of stretching */
            width: 100%;            /* full width */
        }

        /* Responsive adjustment for smaller screens */
        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px;      /* smaller height on mobile */
            }
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Service Booking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold text-primary">Motorcycle Service Booking System</h1>
            <p class="lead text-muted mt-3">
                Book your motorcycle service slots easily, save time, and track your service history.
            </p>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-success btn-lg me-2">
                    <i class="fa fa-user-plus"></i> Register Now
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fa fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    </section>

    <!-- Carousel Banner -->
    <div id="landingCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/workshop1.jpg" class="d-block w-100" alt="Motorcycle Workshop">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="fw-bold">Professional Motorcycle Service</h5>
                    <p>Trusted workshops ready to serve you.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/workshop2.jpg" class="d-block w-100" alt="Motorcycle Service">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="fw-bold">Easy Online Booking</h5>
                    <p>Reserve your slot anytime, anywhere.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/workshop3.jpg" class="d-block w-100" alt="Motorcycle Maintenance">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="fw-bold">Track Your Service History</h5>
                    <p>Stay updated with your motorcycle records.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#landingCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#landingCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Features Section -->
    <section class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fa fa-motorcycle fa-3x text-success mb-3"></i>
                <h5 class="fw-bold">Easy Booking</h5>
                <p class="text-muted">Reserve your motorcycle service slot in just a few clicks.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fa fa-clock fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Save Time</h5>
                <p class="text-muted">Avoid long waiting times with scheduled service appointments.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fa fa-history fa-3x text-warning mb-3"></i>
                <h5 class="fw-bold">Service History</h5>
                <p class="text-muted">Track all your past services and payments in one place.</p>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="bg-primary text-white py-4">
        <div class="container text-center">
            <h4 class="fw-bold">Ready to book your next service?</h4>
            <a href="{{ route('service_booking') }}" class="btn btn-light btn-lg mt-2">
                Book Now
            </a>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

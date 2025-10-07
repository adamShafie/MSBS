<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.css')
</head>

<body>
    <!-- Spinner Start -->
     @include('home.spinner')
    <!-- Spinner End -->


    <!-- Topbar Start -->
    @include('home.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('home.navbar')
    <!-- Navbar End -->


    <!-- Carousel Start -->
    @include('home.carousel')
        <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Inspection Tips //</h6>
                <h1 class="mb-5">Quick Motorcycle Self-Inspection</h1>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="/thumbnails/{{$tip->thumbnail}}" alt="Inspection Tip Image">
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">{{$tip->title}}</h5>
                            <small>{{$tip->content}}</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('home.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

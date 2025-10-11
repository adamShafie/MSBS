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
    <div class="container-xxl py-5" style="padding-top: 7rem; padding-bottom: 7rem;">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase" style="font-size: 1.2rem;">// Inspection Tips //</h6>
                <h1 class="mb-5" style="font-size: 2.8rem;">Quick Motorcycle Self-Inspection</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item shadow-lg rounded-4 p-4 bg-white">
                        <div class="position-relative overflow-hidden mb-4 text-center">
                            <img class="img-fluid rounded-3" src="/thumbnails/{{$tip->thumbnail}}" alt="Inspection Tip Image" style="max-width: 400px; width: 100%; height: auto;">
                        </div>
                        <div class="text-center"  style="background-color: #f1f1f1; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px; text-align: left; font-family: Arial, sans-serif; color: #333; line-height: 1.6; font-size: 16px;">
                            <h3 class="fw-bold mb-3" style="font-size: 2rem;">{{$tip->title}}</h3>
                            <p class="lead" style="font-size: 1.15rem;">{{$tip->content}}</p>
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

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .booking {
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .booking h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .booking .form-label {
            font-weight: 500;
            color: #333;
        }

        .booking .form-control,
        .booking .form-select {
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .booking .input-group-text {
            background: #f8f9fa;
            border-radius: 0.5rem;
        }

        .booking .btn-primary {
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.08);
        }

        .booking .bg-white {
            border-radius: 1rem;
        }

        @media (max-width: 991px) {
            .booking .col-lg-6 {
                padding: 2rem 0 !important;
            }
        }
    </style>
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

    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-white h-100 d-flex flex-column justify-content-center rounded-4 shadow wow zoomIn"
                        data-wow-delay="0.6s" style="padding: 3rem 2rem;">
                        <h2 class="text-primary mb-4">Book For A Service</h2>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="service" class="form-label">Select A Service</label>
                                    <select id="service" class="form-select" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="date" class="form-label">Service Date</label>
                                    <input type="date" id="date" class="form-control" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="time" class="form-label">Service Time</label>
                                    <select id="time" class="form-select" required>
                                        <option selected disabled value="">Choose time slot...</option>
                                        <option value="8-9">8:00 am - 9:00 am</option>
                                        <option value="9-10">9:00 am - 10:00 am</option>
                                        <option value="10-11">10:00 am - 11:00 am</option>
                                        <option value="11-12">11:00 am - 12:00 pm</option>
                                        <option value="14-15">2:00 pm - 3:00 pm</option>
                                        <option value="15-16">3:00 pm - 4:00 pm</option>
                                        <option value="16-17">4:00 pm - 5:00 pm</option>
                                        <option value="17-18">5:00 pm - 6:00 pm</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="request" class="form-label">Special Request</label>
                                    <textarea id="request" class="form-control" rows="3" placeholder="Any special request?"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>
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
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Prevent past dates
    var dateInput = document.getElementById('date');
    var today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);

    // Prevent past time slots if today is selected
    dateInput.addEventListener('change', function () {
        var selectedDate = this.value;
        var timeSelect = document.getElementById('time');
        var now = new Date();
        var currentHour = now.getHours();

        // Enable all time slots first
        Array.from(timeSelect.options).forEach(function (option) {
            option.disabled = false;
        });

        if (selectedDate === today) {
            Array.from(timeSelect.options).forEach(function (option) {
                var slot = option.value;
                var startHour = parseInt(slot.split('-')[0]);
                if (!isNaN(startHour) && startHour <= currentHour) {
                    option.disabled = true;
                }
            });
        }
    });
});
</script>
</body>

</html>

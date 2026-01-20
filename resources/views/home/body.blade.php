<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Welcome to MSBS</h2>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- ✅ Quick Stats Cards -->
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">My Bookings</h5>
                        <p class="card-text display-6">{{ $bookingsCount ?? 0 }}</p>
                        <a href="{{ route('my_bookings') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pending Payments</h5>
                        <p class="card-text display-6">{{ $pendingPaymentsCount ?? 0 }}</p>
                        <a href="{{ route('my_bookings', ['status' => 'paid']) }}" class="btn btn-warning btn-sm">Pay Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Completed Services</h5>
                        <p class="card-text display-6">{{ $completedServicesCount ?? 0 }}</p>
                        <a href="{{ route('service_history') }}" class="btn btn-success btn-sm">History</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <p class="card-text"><i class="fa fa-user-circle fa-2x"></i></p>
                        <!-- ✅ Fixed route name -->
                        <a href="{{ route('view_profile') }}" class="btn btn-secondary btn-sm">View Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ Recent Activity -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        @if(!empty($recentBookings) && count($recentBookings) > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($recentBookings as $booking)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <strong>{{ $booking->service_type }}</strong>
                                            - {{ $booking->motorcycle->model ?? 'N/A' }}
                                            [{{ $booking->motorcycle->plate_number ?? 'N/A' }}]
                                        </span>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No recent activity.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .badge {
        font-size: 1rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }
    .card {
        border-radius: 10px;
    }
    .card .card-body {
        padding: 20px;
    }
</style>

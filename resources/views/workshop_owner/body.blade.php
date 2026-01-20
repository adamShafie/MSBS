<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Welcome, Workshop Owner</h2>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- ✅ Quick Stats Cards -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <p class="card-text display-6">{{ $totalBookings ?? 0 }}</p>
                        <a href="{{ route('view_bookings') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pending Approvals</h5>
                        <p class="card-text display-6">{{ $pendingApprovals ?? 0 }}</p>
                        <a href="{{ route('view_bookings', ['status' => 'pending']) }}" class="btn btn-warning btn-sm">Review</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Completed Services</h5>
                        <p class="card-text display-6">{{ $completedServices ?? 0 }}</p>
                        <a href="{{ route('service_history') }}" class="btn btn-success btn-sm">History</a>
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
                                        <span class="badge
                                            @if($booking->status == 'pending') bg-warning text-light
                                            @elseif($booking->status == 'approved') bg-success text-light
                                            @elseif($booking->status == 'rejected') bg-danger text-light
                                            @elseif($booking->status == 'paid') bg-info text-light
                                            @elseif($booking->status == 'completed') bg-secondary text-light
                                            @endif">
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
    .card {
        border-radius: 10px;
    }
    .card .card-body {
        padding: 20px;
    }
    .list-group-item {
        border: none;
        border-bottom: 1px solid #eee;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
</style>

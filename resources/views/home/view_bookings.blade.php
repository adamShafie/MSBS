<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>My Service Bookings</title>
    <style>
      body {
        background-color: #f1f5f9;
        color: #1a202c;
        font-family: "Poppins", sans-serif;
      }

      h2.page-title {
        font-weight: 600;
        color: #0f172a;
        border-left: 6px solid #007bff;
        padding-left: 12px;
        margin-bottom: 25px;
      }

      .card {
        background-color: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        transition: all 0.2s ease;
      }

      .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }

      .card-header {
        background-color: #007bff;
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .booking-date {
        font-size: 0.9rem;
        opacity: 0.9;
      }

      .card-body {
        padding: 20px 25px;
        background-color: #ffffff;
      }

      .detail-item {
        margin-bottom: 10px;
      }

      .detail-item strong {
        display: inline-block;
        width: 160px;
        color: #334155;
      }

      .status {
        font-weight: 600;
        text-transform: capitalize;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 0.9rem;
      }

      .status.pending {
        color: #b45309;
        background-color: #fef3c7;
      }

      .status.approved {
        color: #166534;
        background-color: #dcfce7;
      }

      .status.rejected {
        color: #991b1b;
        background-color: #fee2e2;
      }

      .alert-info {
        background-color: #e0f2fe;
        border: 1px solid #bae6fd;
        color: #0c4a6e;
        border-radius: 10px;
        padding: 15px 20px;
        font-weight: 500;
      }
        .alert-info .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-top: 10px;
        }
        .alert-info .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

    </style>
  </head>

  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
        <main class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title">My Service Bookings</h2>
                <div class="d-flex gap-2">
                    <!-- Add Booking Button -->
                    <a href="{{ route('service_booking') }}" class="btn btn-success" style=" background-color: green; border-color: green;">
                        <i class="fa fa-plus me-1"></i> Make a Booking
                    </a>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
            <!-- Filter by Status -->
                <form action="{{ route('my_bookings') }}" method="GET" class="d-flex">
                <label for="status" style="color: black; margin-right: 10px; font-weight: bold;"> Filter by Status:</label>

                <select name="status" class="form-select me-2" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                     </select>
                    <noscript><button type="submit" class="btn btn-primary">Filter</button></noscript>
                </form>
            </div>

            @if($bookings->isEmpty())
            <div class="alert alert-info d-flex align-items-center">
                <i class="fa fa-info-circle me-2" style="margin-right: 10px;"></i>
                <span>You haven’t made any bookings yet.</span>
                <a href="{{ route('service_booking') }}" class="btn btn-primary ms-auto" style="margin-left: 10px;">Book Now</a>
            </div>
            @else
            @foreach($bookings as $booking)
            @if($booking->status !== 'completed')
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span><strong>Booking #{{ $booking->id }}</strong></span>
                    <span class="booking-date">
                        {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="mb-2"><strong>Motorcycle:</strong> {{ $booking->motorcycle->model ?? 'N/A' }} [{{ $booking->motorcycle->plate_number ?? 'N/A' }}]</div>
                    <div class="mb-2"><strong>Service Type:</strong> {{ $booking->service_type }}</div>
                    <div class="mb-2"><strong>Preferred Date:</strong> {{ \Carbon\Carbon::parse($booking->preferred_date)->format('d-m-Y') }}</div>
                    <div class="mb-2"><strong>Time Slot:</strong> {{ $booking->time_slot }}</div>
                    <div class="mb-2"><strong>Remarks:</strong> {{ $booking->remarks ?? '-' }}</div>
                    <div class="mb-2">
                        <strong>Status:</strong>
                        <span class="badge
                            @if($booking->status == 'pending') bg-warning text-dark
                            @elseif($booking->status == 'approved') bg-success
                            @elseif($booking->status == 'rejected') bg-danger
                            @elseif($booking->status == 'paid') bg-success
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    @if($booking->status == 'rejected' && $booking->bookingApproval && $booking->bookingApproval->rejection_reason)
                    <div class="mb-2">
                        <strong>Rejection Reason:</strong>
                        <span class="text-danger fw-bold">{{ $booking->bookingApproval->rejection_reason ?? 'N/A' }}</span>
                    </div>
                    @endif

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        @if($booking->status == 'pending')
                            <a href="{{ route('edit_booking', $booking->id) }}" class="btn btn-warning" style=" color: white; background-color: blue; border-color: blue;">
                                <i class="fa fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('delete_booking', $booking->id) }}"
                            onclick="return confirm('Are you sure you want to delete this booking?')"
                            class="btn btn-danger" style=" background-color: red; border-color: red; margin-left: 10px;">
                                <i class="fa fa-trash me-1"></i> Delete
                            </a>
                        @endif

                        @if($booking->status == 'approved' && $booking->payment && $booking->payment->payment_status == 'pending')
                            <a href="{{ route('make_payment', $booking->id) }}" class="btn btn-success" style=" background-color: green; border-color: green; margin-left: 10px;">
                                <i class="fa fa-dollar me-1"></i> Make Payment
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </main>
    </div>

    @include('home.footer')
  </body>
</html>

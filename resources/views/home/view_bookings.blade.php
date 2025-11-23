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
          <a style="background-color: #00a434ff; border-color: #00a434ff" href="{{ route('service_booking') }}" class="btn btn-primary"><i class="fa fa-plus"> Make a Booking</i></a>
        </div>

        @if($bookings->isEmpty())
          <div class="alert alert-info">
            You haven’t made any bookings yet.
            <a href="{{ route('service_booking') }}" class="btn btn-primary">Book Now</a>
          </div>
        @else
          @foreach($bookings as $booking)
            <div class="card">
              <div class="card-header">
                <span>Booking #{{ $booking->id }}</span>
                <span class="booking-date">
                  {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}
                </span>
              </div>

              <div class="card-body">
                <div class="detail-item">
                  <strong>Motorcycle:</strong>
                  {{ $booking->motorcycle->model ?? 'N/A' }}
                  [{{ $booking->motorcycle->plate_number ?? 'N/A' }}]
                </div>

                <div class="detail-item">
                  <strong>Service Type:</strong>
                  {{ $booking->service_type }}
                </div>

                <div class="detail-item">
                  <strong>Preferred Date:</strong>
                  {{ \Carbon\Carbon::parse($booking->preferred_date)->format('d-m-Y') }}
                </div>

                <div class="detail-item">
                  <strong>Remarks:</strong>
                  {{ $booking->remarks ?? '-' }}
                </div>

                <div class="detail-item">
                  <strong>Status:</strong>
                  <span class="status {{ strtolower($booking->status) }}">
                    {{ ucfirst($booking->status) }}
                  </span>
                </div>
                @if($booking->status == 'rejected' && $booking->bookingApproval && $booking->bookingApproval->rejection_reason)
                <div class="detail-item" style="margin-top: 10px;">
                    <strong>Rejection Reason:</strong>
                    <span style="color:#b91c1c; font-weight:500;">
                        {{ $booking->bookingApproval->rejection_reason ?? 'N/A' }}
                    </span>
                </div>
                @endif

                @if($booking->status == 'pending')
                <div class="mt-3" style="text-align: right">
                    <a class="btn btn-danger" style="background-color: #dc3545; border-color: #dc3545" onclick="return confirm('Are you sure you want to delete this booking?')" href="{{ route('delete_booking', $booking->id) }}"><i class="fa fa-trash"> Delete</i></a>
                    <a class="btn btn-primary" style="background-color: #007bff; border-color: #007bff" href="{{ route('edit_booking', $booking->id) }}"><i class="fa fa-edit"> Edit</i></a>
                </div>
                @endif

                @if($booking->status == 'approved' && $booking->payment && $booking->payment->payment_status == 'pending')
                <div class="mt-3" style="text-align: right">
                    <a class="btn btn-primary"
                    style="background-color: #007a12ff; border-color: #007a12ff"
                    href="{{ route('make_payment', $booking->id) }}">
                        <i class="fa fa-dollar"></i> Make Payment
                    </a>
                </div>
                @endif

              </div>
            </div>
            @endforeach
        @endif
      </main>
    </div>

    @include('home.footer')
  </body>
</html>

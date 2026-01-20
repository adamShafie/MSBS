<!DOCTYPE html>
<html>
  <head>
    @include('workshop_owner.css')
    <title>Manage Bookings</title>
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

      .filter-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
      }

      .filter-bar input {
        flex: 1;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 8px 12px;
      }

      .filter-bar .btn {
        border-radius: 6px;
        font-weight: 500;
      }

      .card {
        background-color: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
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
        font-size: 1rem;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        padding: 12px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .card-body {
        padding: 18px 22px;
      }

      .detail-item {
        margin-bottom: 8px;
        font-size: 0.95rem;
      }

      .detail-item strong {
        width: 150px;
        display: inline-block;
        color: #334155;
      }

      .status {
        font-weight: 600;
        text-transform: capitalize;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
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

      .action-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 12px;
      }

      .action-buttons .btn {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 6px;
      }
    </style>
  </head>
  <body>
    @include('workshop_owner.header')
    @include('workshop_owner.sidebar')

    <div class="page-content">
      <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="page-title">Service Bookings</h2>
        </div>

        <!-- Filter bar -->
        <form method="GET" action="{{ route('view_bookings') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by customer, plate, or service...">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('view_bookings') }}" class="btn btn-secondary">Reset</a>
        </form>

        <div class="filter-bar mt-2">
        <a href="?status=pending" class="btn btn-warning">Pending</a>
        <a href="?status=approved" class="btn btn-success">Approved</a>
        <a href="?status=rejected" class="btn btn-danger">Rejected</a>
        </div>

        <!-- Booking cards -->
        @foreach($bookings as $booking)
        @if($booking->status !== 'completed')
          <div class="card">
            <div class="card-header">
              <span>Booking #{{ $booking->id }}</span>
              <span class="booking-date">
                {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}
              </span>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
              <div class="detail-item">
                <strong>Motorcycle:</strong>
                {{ $booking->motorcycle->model ?? 'N/A' }}
                [{{ $booking->motorcycle->plate_number ?? 'N/A' }}]
              </div>
              <div class="detail-item">
                <strong>Service Type:</strong> {{ $booking->service_type }}
              </div>
              <div class="detail-item">
                <strong>Preferred Date:</strong>
                {{ \Carbon\Carbon::parse($booking->preferred_date)->format('d-m-Y') }}
              </div>
                <div class="detail-item">
                    <strong>Preferred Time:</strong>
                    {{ $booking->time_slot }}
                </div>
              <div class="detail-item">
                <strong>Status:</strong>
                <span class="status {{ strtolower($booking->status) }}">
                  {{ ucfirst($booking->status) }}
                </span>
              </div>

              <!-- Only View button -->
              <div class="action-buttons">
                <a class="btn btn-info" href="{{ route('booking_details', $booking->id) }}">
                  <i class="fa fa-eye"></i> View
                </a>
              </div>
            </div>
          </div>
            @endif
        @endforeach
      </main>
    </div>

    @include('workshop_owner.footer')
  </body>
</html>

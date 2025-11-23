<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('home.css')
    <title>Make Payment</title>
  </head>

  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="page-title">Make Payment for Booking #{{ $booking->id }}</h2>
        </div>

        <div class="card">
          <div class="card-header">
            <span>Booking #{{ $booking->id }}</span>
            <span class="booking-date">{{ $booking->created_at }}</span>
          </div>
          <div class="card-body">
            <form action="#" method="POST">
              @csrf
              <div class="mb-3">
                <label for="amount" class="form-label">Amount to Pay</label>
                <input type="text" class="form-control" id="amount" name="amount" value="{{ $booking->price }}" readonly>
              </div>
              <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                  <option value="cash">Cash</option>
                  <option value="credit_card">Credit Card</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
          </div>
        </div>
      </main>
    </div>
    @include('home.footer')
  </body>
</html>

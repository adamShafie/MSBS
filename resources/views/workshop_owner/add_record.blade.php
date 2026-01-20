<!DOCTYPE html>
<html>
  <head>
    @include('workshop_owner.css')
    <title>Create Service Record</title>
    <style>
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
            border-left: #007bff 5px solid;
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            font-size: 1.25rem;
            color: #000000ff;
        }
        .card-body {
            padding: 1.25rem;
            color: #000000ff;
            background-color: #ffffff;
        }
        .form-label {
            font-weight: 600;
            color: #000000ff;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            color: #495057;
            border-color: black;
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            color: #495057;
        }
        .form-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
  </head>
  <body>
    @include('workshop_owner.header')
    @include('workshop_owner.sidebar')

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">New Service Record</h4>
              </div>
              <div class="card-body">
                <form action="{{ url('save_record')}}" method="POST">
                  @csrf
                <div class="mb-3">
                    <label for="booking_id" class="form-label">Paid service</label>
                    <br>
                    <select class="form-select" id="booking_id" name="booking_id" required style="border-color: black;">
                    <option value="" disabled selected>Select a paid booking</option>
                    @foreach ($paidBookings as $booking)
                        <option value="{{ $booking->id }}"
                                data-price="{{ $booking->bookingApproval->quoted_price ?? '' }}"
                                data-date="{{ $booking->preferred_date }}"
                                data-slot="{{ $booking->time_slot }}">
                            {{ $booking->motorcycle->model }} -
                            {{ $booking->motorcycle->plate_number }} -
                            {{ $booking->service_type }}
                            (RM{{ $booking->bookingApproval->quoted_price ?? 'N/A' }})
                            - {{ $booking->preferred_date }}
                            ({{ $booking->time_slot }})
                            - Customer: {{ $booking->user->name }}
                        </option>
                    @endforeach
                    </select>
                </div>

                  <div class="mb-3">
                    <label for="service_date" class="form-label">Service Date</label>
                    <input type="date" class="form-control" id="service_date" name="service_date" required style="border-color: black; max-width: 210px;" placeholder="dd-mm-yyyy">
                  </div>

                  <div class="mb-3">
                        <label for="time_slot" class="form-label">Time Slot</label>
                        <input type="text" class="form-control" id="time_slot" name="time_slot"
                            required style="max-width: 210px;" placeholder="Auto-filled time slot">
                  </div>


                  <div class="mb-3">
                    <label for="final_price" class="form-label">Final Price (RM)</label>
                    <input type="number" class="form-control" id="final_price" name="final_price"
                    required style="max-width: 210px;" placeholder="Enter final price" step="1.00" min="1.00">
                  </div>

                  <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3" style="color: black;"></textarea>
                  </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('service_history') }}" class="btn btn-secondary" style=" background-color: grey; border-color: grey; margin-right: 10px;">
                        <i class="fa fa-times me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('workshop_owner.footer')

    <script>
        document.getElementById('booking_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            // ✅ Autofill Final Price
            const priceMatch = selectedOption.text.match(/\(RM(\d+(\.\d+)?)\)/);
            if (priceMatch) {
                document.getElementById('final_price').value = priceMatch[1];
            }

            // ✅ Autofill Service Date
            // Assuming preferred_date is printed in YYYY-MM-DD format in the option text
            const dateMatch = selectedOption.text.match(/(\d{4}-\d{2}-\d{2})/);
            if (dateMatch) {
                document.getElementById('service_date').value = dateMatch[1];
            }
            // Autofill Time Slot
            const slot = selectedOption.getAttribute('data-slot');
            if (slot) {
                document.getElementById('time_slot').value = slot;
            }
        });
    </script>

  </body>
</html>

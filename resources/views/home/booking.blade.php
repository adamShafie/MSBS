<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>Service Booking</title>
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
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Motorcycle Service Booking</h4>
              </div>
              <div class="card-body">
                <form action="{{ url('save_booking')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="model" class="form-label">Select Motorcycle</label>
                    <br>
                    <select class="form-select" id="motorcycle_id" name="motorcycle_id" required style="border-color: black;">
                      <option value="" disabled selected>Select your motorcycle</option>
                    @foreach ($motorcycles as $motorcycle)
                      <option value="{{ $motorcycle->motorcycle_id }}">
                        {{ $motorcycle->model }} - {{ $motorcycle->plate_number }}
                      </option>
                    @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="service_type" class="form-label">Service Type</label>
                    <br>
                    <select class="form-select" id="service_type" name="service_type" required style="border-color: black;">
                      <option value="" disabled selected>Select a service type</option>
                      <option value="Engine Service">Engine Service</option>
                      <option value="Lubricant & Oil Change">Lubricant & Oil Change</option>
                      <option value="Tire Change">Tire Change</option>
                      <option value="Chain Maintenance">Chain Maintenance</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                    <div class="mb-3">
                    <label for="preferred_date" class="form-label">Preferred Date</label>
                    <input type="date" name="preferred_date" id="preferred_date"
                        class="form-control" value="{{ $date }}" required min="{{ date('Y-m-d') }}" style="border-color: black; max-width: 210px;">
                    </div>

                    <div class="mb-3">
                    <label for="time_slot" class="form-label">Preferred Time Slot</label>
                    <br>
                    <select name="time_slot" id="time_slot" class="form-select" required style="border-color: black;">
                        <option value="">-- Select a Time Slot --</option>
                        @foreach($availableSlots as $slot)
                            <option value="{{ $slot }}">{{ $slot }}</option>
                        @endforeach
                    </select>
                    </div>
                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3" style="color: black;"></textarea>
                  </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('view_bookings') }}" class="btn btn-secondary" style=" background-color: grey; border-color: grey; margin-right: 10px;">
                            <i class="fa fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">Book Service
                        </button>
                    </div>
                </form>
                <script>
                document.getElementById('preferred_date').addEventListener('change', function() {
                    let date = this.value;
                    fetch(`/available-slots?date=${date}`)
                        .then(response => response.json())
                        .then(slots => {
                            let slotSelect = document.getElementById('time_slot');
                            slotSelect.innerHTML = '<option value="">-- Select a Time Slot --</option>';
                            slots.forEach(slot => {
                                let option = document.createElement('option');
                                option.value = slot;
                                option.textContent = slot;
                                slotSelect.appendChild(option);
                            });
                        });
                });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('home.footer')
  </body>
</html>

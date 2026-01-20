<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>Service History</title>
    <style>
      .table thead th {
        border: 1px solid #000000ff;
        border-bottom: 2px solid #000000ff;
        background-color: lightgray;
        font-weight: 600;
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #000000ff;
      }
      .table tbody td {
        border: 1px solid #000000ff;
        background-color: #ffffffe1;
        vertical-align: middle;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #000000ff;
        text-align: center;
      }
      .badge-service {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 6px;
      }
      .badge-maintenance { background-color: #e0f2fe; color: #0c4a6e; }
      .badge-repair { background-color: #fee2e2; color: #991b1b; }
    </style>
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <div class="container-fluid py-4">
        <div class="mb-4">
          <h3 style="color: black; font-weight: 600;">Service History</h3>
        </div>

        <!-- Search bar below heading -->
        <div class="mb-4">
          <form action="{{ route('service_history') }}" method="GET" class="d-flex" style="max-width: 500px;">
            <input type="text" name="search" class="form-control me-2"
                   placeholder="Search by date, motorcycle, service type..."
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary" style="background-color: blue; border-color: blue; margin-left: 10px;">Search</button>
          </form>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0 shadow-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Service Date</th>
                <th>Time Slot</th>
                <th>Service Type</th>
                <th>Cost</th>
                <th>Motorcycle</th>
                <th>Customer</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              @if ($records->isEmpty())
              <tr>
                <td colspan="8" class="text-center text-muted">
                  No service history available.<br>
                </td>
              </tr>
              @endif

              @foreach($records as $record)
              <tr>
                <td>{{ $record->record_id }}</td>
                <td>{{ \Carbon\Carbon::parse($record->service_date)->format('d-m-Y') }}</td>
                <td>{{ $record->booking->time_slot }}</td>
                <td>
                  <span class="badge-service
                    {{ strtolower($record->service_type) == 'maintenance' ? 'badge-maintenance' : 'badge-repair' }}">
                    {{ ucfirst($record->service_type) }}
                  </span>
                </td>
                <td>RM {{ number_format($record->final_price, 2) }}</td>
                <td>{{ $record->booking->motorcycle->brand }} {{ $record->booking->motorcycle->model }} ({{ $record->booking->motorcycle->plate_number }})</td>
                <td>{{ $record->user->name }} (ID: {{ $record->user->id }})</td>
                <td>{{ $record->remarks ?? 'N/A' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @include('home.footer')
  </body>
</html>

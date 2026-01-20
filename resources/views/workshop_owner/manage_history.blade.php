<!DOCTYPE html>
<html>
  <head>
    @include('workshop_owner.css')
    <title>Manage Service History</title>
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
      .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
      }
      .btn-sm i { margin-right: 4px; }
    </style>
  </head>
  <body>
    @include('workshop_owner.header')
    @include('workshop_owner.sidebar')

    <div class="page-content">
      <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 style="color: black; font-weight: 600;">Manage Service History</h3>
          <a href="{{ route('add_record') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Add Record
          </a>
        </div>

        <div class="mb-4">
            <form action="{{ route('service_history') }}" method="GET" class="d-flex" style="max-width: 500px;">
                <input type="text" name="search" class="form-control me-2"
                    placeholder="Search by customer, motorcycle, service type..."
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($records->isEmpty())
              <tr>
                <td colspan="9" class="text-center text-muted">
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
                <td>
                  <div class="action-buttons">
                    <a href="{{ url('edit_record', $record->record_id) }}" class="btn btn-primary btn-sm" title="Edit Record" style="background-color: blue; border-color: blue;">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ url('delete_record', $record->record_id) }}"
                       onclick="return confirm('Are you sure you want to delete this record?')"
                       class="btn btn-danger btn-sm" title="Delete Record" style="background-color: red; border-color: red;">
                      <i class="fa fa-trash"></i> Delete
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @include('workshop_owner.footer')
  </body>
</html>

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
      .table img {
        border-radius: 0.5rem;
      }
      .table tbody td .btn {
        color: #fff !important;
      }
      .table tbody td .btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
      }
      .table tbody td .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
      }
      .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem; /* Adjust spacing as needed */
      }
    </style>

  </head>
  <body>
    @include('workshop_owner.header')
    @include('workshop_owner.sidebar')
    <div class="page-content">
      <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 style="color: black; font-weight: 600; margin-bottom: 20px;">Manage Service History</h3>
                <a style="background-color: #00a434ff; border-color: #00a434ff" href="{{ route('add_record') }}" class="btn btn-primary"><i class="fa fa-plus"> Add Record</i></a>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle mb-0" style="border-radius: 0.25rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <thead>
                  <tr class="text-center" style="border-bottom: 2px solid #dee2e6;">
                    <th>ID</th>
                    <th>Service Date</th>
                    <th>Service Type</th>
                    <th>Cost</th>
                    <th>Motorcycle</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($records->isEmpty())
                  <tr>
                      <td colspan="6">No service history available.</td>
                  </tr>
                  @endif
                  @foreach($records as $record)
                  <tr>
                    <td>{{ $record->record_id }}</td>
                    <td>{{ $record->service_date }}</td>
                    <td>{{ $record->service_type }}</td>
                    <td>{{ $record->final_price }}</td>
                    <td>{{ $record->booking->motorcycle->model }}</td>
                    <td>
                      <div class="action-buttons">
                        <a href="{{ url('edit_record', $record->record_id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ url('delete_record', $record->record_id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger btn-sm">Delete</a>
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

<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
      .table thead th {
        border: 1px solid #dee2e6;
        background-color: #70707070;
        font-weight: 600;
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #ffffffff;
      }
      .table tbody td {
        border: 1px solid #dee2e6;
        vertical-align: middle;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #ffffffff;
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
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="container-fluid py-4">
        <h2 class="h5 mb-4">Manage Inspection Tips</h2>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                  <tr class="text-center" style="border-bottom: 2px solid #dee2e6;">
                    <th style="width:60px;">No</th>
                    <th style="width:200px;">Title</th>
                    <th>Content</th>
                    <th style="width:120px;">Image</th>
                    <th style="width:150px;">Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    @foreach($tips as $data)
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{!! Str::limit($data->content, 50) !!}</td>
                    <td>
                      <img class="img-fluid" width="100" height="100" src="thumbnails/{{ $data->thumbnail }}" alt="Tip Image">
                    </td>
                    <td>
                      <div class="action-buttons">
                        <a href="{{ url('delete_inspection_tips', $data->id) }}" class="btn btn-sm btn-danger mb-1" title="Delete" onclick="return confirm('Are you sure to delete this tip?')">
                          <i class="fa fa-trash"></i> Delete
                        </a>
                        <a href="{{ url('edit_inspection_tips', $data->id) }}" class="btn btn-sm btn-primary mb-1" title="Edit">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  <!-- Add more rows dynamically here -->
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mb-3" style="margin-top: 20px;">
              <a href="{{ url('add_inspection_tips') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Add New Tip
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>

<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <title>Manage Inspection Tips</title>
    <style>
      .table thead th {
        border: 1px solid #000;
        border-bottom: 2px solid #000;
        background-color: lightgray;
        font-weight: 600;
        text-align: center;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #000;
      }
      .table tbody td {
        border: 1px solid #000;
        background-color: #fff;
        text-align: center;
        padding: 0.75rem;
        font-size: 0.95rem;
        color: #000;
      }
      .table tbody tr:hover {
        background-color: #f1f5f9;
      }
      .table img {
        border-radius: 0.5rem;
      }
      .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
      }

      /* ✅ Custom Pagination Styling */
      .pagination {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 20px;
      }
      .pagination .page-item {
        list-style: none;
      }
      .pagination .page-link {
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 5px;
        padding: 6px 12px;
        text-decoration: none;
        transition: all 0.2s ease;
      }
      .pagination .page-link:hover {
        background-color: #007bff;
        color: #fff;
      }
      .pagination .active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
      }
      .pagination .disabled .page-link {
        color: #999;
        border-color: #ccc;
        cursor: not-allowed;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 style="color: black; font-weight: 600;">Manage Inspection Tips</h3>
          <a href="{{ url('add_inspection_tips') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Add New Tip
          </a>
        </div>

        <!-- ✅ Search bar -->
        <form action="{{ route('manage_inspection_tips') }}" method="GET" class="d-flex mb-3" style="max-width: 400px;">
          <input type="text" name="search" class="form-control me-2"
                 placeholder="Search tips by title or content..."
                 value="{{ request('search') }}">
          <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; margin-left: 10px;">Search</button>
        </form>

        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0" style="border-radius: 0.25rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <thead>
              <tr class="text-center">
                <th style="width:60px;">ID</th>
                <th style="width:200px;">Title</th>
                <th>Content</th>
                <th style="width:120px;">Image</th>
                <th style="width:150px;">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($tips->isEmpty())
                <tr>
                  <td colspan="5">No inspection tips available.</td>
                </tr>
              @else
                @foreach($tips as $data)
                  <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{!! Str::limit($data->content, 50) !!}</td>
                    <td>
                      <img class="img-fluid" width="100" height="100" src="thumbnails/{{ $data->thumbnail }}" alt="Tip Image">
                    </td>
                    <td>
                      <div class="action-buttons">
                        <a href="{{ url('edit_inspection_tips', $data->id) }}" class="btn btn-sm btn-primary" title="Edit" style="background-color: #007bff; border-color: #007bff; margin-right: 5px;">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ url('delete_inspection_tips', $data->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure to delete this tip?')" style="background-color: #dc3545; border-color: #dc3545;">
                          <i class="fa fa-trash"></i> Delete
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <!-- ✅ Result count -->
        <div class="text-muted text-center mt-3">
          Showing {{ $tips->firstItem() }} to {{ $tips->lastItem() }} of {{ $tips->total() }} results
        </div>

        <!-- ✅ Custom Pagination -->
        <nav>
          <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($tips->onFirstPage())
              <li class="page-item disabled"><span class="page-link">« Previous</span></li>
            @else
              <li class="page-item"><a class="page-link" href="{{ $tips->previousPageUrl() }}">« Previous</a></li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($tips->getUrlRange(1, $tips->lastPage()) as $page => $url)
              <li class="page-item {{ $tips->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($tips->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $tips->nextPageUrl() }}">Next »</a></li>
            @else
              <li class="page-item disabled"><span class="page-link">Next »</span></li>
            @endif
          </ul>
        </nav>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>

<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>Inspection Tips</title>
    <style>
      .tip-list {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      .tip-item {
        background-color: lightgray;
        border: 1px solid #000000;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        transition: background-color 0.2s ease;
      }
      .tip-item:hover {
        background-color: #e6e6e6;
      }
      .tip-title {
        font-weight: 600;
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 10px;
      }
      .tip-thumbnail {
        max-width: 200px;
        border-radius: 6px;
        margin-bottom: 10px;
      }
      .tip-content {
        color: #555;
        margin-bottom: 10px;
      }
      .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
      }
      .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004a99;
      }

      /* ✅ Custom Pagination styling */
      .pagination {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px;
        padding-left: 0;
        margin-top: 10px;
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
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content" style="min-height: 100vh; overflow-y: auto;">
      <div class="container py-4">
        <h3 class="mb-4" style="color: black; font-weight: 600;">Inspection Tips</h3>

        <!-- ✅ Search bar -->
        <form action="{{ route('view_inspection_tips') }}" method="GET" class="d-flex mb-4" style="max-width: 500px;">
          <input type="text" name="search" class="form-control me-2"
                 placeholder="Search tips by title or content..."
                 value="{{ request('search') }}">
          <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Search</button>
        </form>

        <!-- ✅ List of tips -->
        @if($tips->isEmpty())
          <div class="alert alert-warning text-center">
            No results found.
          </div>
        @else
          <ul class="tip-list">
            @foreach($tips as $tip)
              <li class="tip-item">
                <div class="tip-title">{{ $tip->title }}</div>
                @if($tip->thumbnail)
                  <img src="/thumbnails/{{ $tip->thumbnail }}" alt="Tip Image" class="tip-thumbnail">
                @endif
                <div class="tip-content">{!! Str::limit($tip->content, 100, '...') !!}</div>
                <a href="{{ url('inspection_tips_details', $tip->id) }}" class="btn btn-primary">
                  Read More
                </a>
              </li>
            @endforeach
          </ul>

          <!-- ✅ Result count -->
          <div class="text-muted text-center mb-2">
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
        @endif
      </div>
    </div>

    @include('home.footer')
  </body>
</html>

<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
            <h4 class="card-title">My Service History</h4>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Service ID</th>
                        <th>Service Date</th>
                        <th>Service Type</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($records as $records)
                      <tr>
                        <td>{{ $records->id }}</td>
                        <td>{{ $records->service_date }}</td>
                        <td>{{ $records->service_type }}</td>
                        <td>{{ $records->status }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    @include('home.footer')
  </body>
</html>

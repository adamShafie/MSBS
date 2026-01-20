<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>User Profile</title>
    <style>
        body{
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }
        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
            border-left: 5px solid #007bff;
            border-right: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
            background-color: #fafafa;
            border-radius: .25rem;
        }

        .profile {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile h2 {
            margin-bottom: 20px;
            font-size: 28px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .profile .card {
            margin-bottom: 20px;
        }
        .profile .card h6 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .profile .card .row {
            margin-bottom: 10px;
        }
        .profile .card .row:last-child {
            margin-bottom: 0;
        }
        .profile .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
        .profile .btn:hover {
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
        }
        hr {
            border-top: 1px solid #e2e8f0;
        }
        @media (max-width: 600px) {
            .profile h2 {
                font-size: 24px;
            }
            .profile .card h6 {
                font-size: 16px;
            }
        }
    </style>
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
    <main>
        <section class="profile">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Motorcycle Information</h2>
            <a class="btn btn-success" href="{{ url('add_motorcycle') }}" style=" background-color: green; border-color: green;">
                <i class="fa fa-plus me-1"></i> Add Motorcycle
            </a>
        </div>

        @if(count($motorcycles) == 0)
            <div class="alert alert-info col-md-8">
                <i class="fa fa-info-circle me-1"></i> Please add your motorcycle details.
            </div>
        @endif

        <div class="col-md-8">
            @foreach($motorcycles as $motorcycle)
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">
                        <span class="badge bg-primary me-2">#{{ $loop->iteration }}</span>
                        {{ $motorcycle->brand }} {{ $motorcycle->model }}
                    </h4>

                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Plate Number</div>
                        <div class="col-md-8 text-dark">{{ $motorcycle->plate_number }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Engine Capacity</div>
                        <div class="col-md-8 text-dark">{{ $motorcycle->engine_capacity }} cc</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Year</div>
                        <div class="col-md-8 text-dark">{{ $motorcycle->year }}</div>
                    </div>

                    <div class="justify-content-end d-flex mt-4">
                        <a class="btn btn-warning" href="{{ route('edit_motorcycle', $motorcycle->motorcycle_id) }}">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>
                        <a class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this motorcycle?')"
                        href="{{ route('delete_motorcycle', $motorcycle->motorcycle_id) }}" style=" background-color: red; border-color: red; margin-left: 10px;">
                            <i class="fa fa-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
    </div>

    @include('home.footer')
  </body>
</html>

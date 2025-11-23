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
        <h2>Motorcycle Information</h2>
            <div class="col-sm-12">
                <a class="btn btn-info" href="{{ url('add_motorcycle') }}" style="background-color: #009b17ff; align-items: right; float: right;"><i class="fa fa-plus"></i> Add</a>
            </div>
            @if(count($motorcycles) == 0)
            <div class="col-md-8">
                <h4>Please add your motorcycle details.</h4>
            </div>
            @endif
            <div class="col-md-8">
            @foreach($motorcycles as $motorcycle)
            <div class="card mb-4">
                <div class="card-body">
                <h3 class="mb-3"><strong>Motorcycle {{ $loop->iteration }}</strong></h3>
                <hr>

                <div class="row mb-2">
                    <div class="col-sm-4"><strong>Plate Number</strong></div>
                    <div class="col-sm-8" style="color: black;">{{ $motorcycle->plate_number }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4"><strong>Brand</strong></div>
                    <div class="col-sm-8" style="color: black;">{{ $motorcycle->brand }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4"><strong>Model</strong></div>
                    <div class="col-sm-8" style="color: black;">{{ $motorcycle->model }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4"><strong>Engine Capacity</strong></div>
                    <div class="col-sm-8" style="color: black;">{{ $motorcycle->engine_capacity }} cc</div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Year</strong></div>
                    <div class="col-sm-8" style="color: black;">{{ $motorcycle->year }}</div>
                </div>
                <hr>
                <div class="text-end" style="align-items: right; float: right; margin-left: 5px;">
                    <a class="btn btn-info" href="{{ route('edit_motorcycle', $motorcycle->motorcycle_id) }}">
                    <i class="fa fa-edit"></i> Edit
                    </a>
                </div>
                <div class="text-end" style="align-items: right; float: right;">
                    <a class="btn btn-info" onclick="return confirm('Are you sure you want to delete this motorcycle?')" href="{{ route('delete_motorcycle', $motorcycle->motorcycle_id) }}" style="background-color: hsla(0, 98%, 49%, 1.00);">
                    <i class="fa fa-trash"></i> Delete
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

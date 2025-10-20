<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
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
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
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
        <h2>Add Motorcycle</h2>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <form action="{{ route('save_motorcycle') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="plate_number">Plate Number</label>
                  <input type="text" name="plate_number" id="plate_number" class="form-control" placeholder="Enter plate number" required>
                  <div class="invalid-feedback">Please enter the plate number.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="brand">Brand</label>
                  <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter brand" required>
                  <div class="invalid-feedback">Please enter the brand.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="model">Model</label>
                  <input type="text" name="model" id="model" class="form-control" placeholder="Enter model" required>
                  <div class="invalid-feedback">Please enter the model.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="engine_capacity">Engine Capacity (cc)</label>
                  <input type="number" name="engine_capacity" id="engine_capacity" class="form-control" placeholder="Enter engine capacity" required>
                  <div class="invalid-feedback">Please enter the engine capacity.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="year">Year</label>
                  <input type="number" name="year" id="year" class="form-control" placeholder="Enter year" required>
                  <div class="invalid-feedback">Please enter the year.</div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    </div>

    @include('home.footer')
  </body>
</html>

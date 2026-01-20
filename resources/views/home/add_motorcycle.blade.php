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

            {{-- Global error list (optional, can keep or remove) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('save_motorcycle') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="plate_number">Plate Number</label>
                    <input type="text" name="plate_number" id="plate_number"
                        class="form-control @error('plate_number') is-invalid @enderror"
                        placeholder="Enter plate number" value="{{ old('plate_number') }}" required>
                    @error('plate_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Please enter the plate number.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="brand">Brand</label>
                    <input type="text" name="brand" id="brand"
                        class="form-control @error('brand') is-invalid @enderror"
                        placeholder="Enter brand" value="{{ old('brand') }}" required>
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Please enter the brand.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="model">Model</label>
                    <input type="text" name="model" id="model"
                        class="form-control @error('model') is-invalid @enderror"
                        placeholder="Enter model" value="{{ old('model') }}" required>
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Please enter the model.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="engine_capacity">Engine Capacity (cc)</label>
                    <input type="number" name="engine_capacity" id="engine_capacity"
                        class="form-control @error('engine_capacity') is-invalid @enderror"
                        placeholder="Enter engine capacity" value="{{ old('engine_capacity') }}" required>
                    @error('engine_capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Please enter the engine capacity.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="year">Year</label>
                    <input type="number" name="year" id="year"
                        class="form-control @error('year') is-invalid @enderror"
                        placeholder="Enter year" value="{{ old('year') }}" required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Please enter the year.</div>
                    @enderror
                </div>

                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('motorcycle_details') }}" class="btn btn-secondary" style=" background-color: grey; border-color: grey; margin-right: 10px;">
                        <i class="fa fa-times me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save
                    </button>
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

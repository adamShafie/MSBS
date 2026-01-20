<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
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
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
    <main>
        <section class="profile">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">User Information</h2>
            <div>
                <a href="{{ route('edit_profile', Auth::user()->id) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit me-1"></i> Edit
                </a>
                <a href="{{ url('delete_profile', Auth::user()->id) }}"
                onclick="return confirm('Are you sure you want to delete your profile?')"
                class="btn btn-danger" style="background-color: red; border-color: red;">
                    <i class="fa fa-trash me-1"></i> Delete
                </a>
            </div>
        </div>

        <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold" style="color: black; font-weight: bold;">Full Name</div>
                    <div style="color: black;">{{ Auth::user()->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold" style="color: black; font-weight: bold;">Email</div>
                    <div style="color: black;">{{ Auth::user()->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold" style="color: black; font-weight: bold;">Phone Number</div>
                    <div style="color: black;">{{ Auth::user()->phone }}</div>
                </div>
            </div>
        </div>
    </div>
    </section>
    </main>
    </div>

    @include('admin.footer')
  </body>
</html>

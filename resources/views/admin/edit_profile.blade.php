<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
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
        <h2>Update Profile</h2>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <form action="{{url('update_profile' , $user->id)}}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="name"><h6 style="color: black;">Full Name</h6></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="{{$user->name}}" required style="color: black;" autofocus>
                  <div class="invalid-feedback">Please enter your name.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="email"><h6 style="color: black;">Email</h6></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{$user->email}}" required style="color: black;"/>
                  <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="phone"><h6 style="color: black;">Phone Number</h6></label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" value="{{$user->phone}}" required style="color: black;"/>
                  <div class="invalid-feedback">Please enter your phone number.</div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    </div>

    @include('admin.footer')
  </body>
</html>

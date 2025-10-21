<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('home.css')
    <title>Inspection Tip Details</title>
    <style>
      .card {
          box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
      }
    </style>
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h3 style="color: black; font-weight: 600; margin-bottom: 20px;">Inspection Tip Details</h3>
            <div class="card mb-4">
              <div class="card-body">
                <h4 class="card-title" style="font-weight: 600; color: #007bff;">{{ $tip->title }}</h4>
                @if($tip->thumbnail)
                <img src="/thumbnails/{{ $tip->thumbnail }}" class="card-img-bottom" alt="Tip Image" style="max-width: 500px; height: auto; margin: 15px;">
                 @endif
                <p class="card-text" style="color: white;">{!! $tip->content !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('home.footer')
  </body>
</html>

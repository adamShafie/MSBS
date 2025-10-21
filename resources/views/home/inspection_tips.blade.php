<!DOCTYPE html>
<html>
  <head>
    @include('home.css')
    <title>Inspection Tips</title>
    <style>
      .card {
          box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
      }
    </style>
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content" style="height: 100vh; overflow-y: auto;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 style="color: black; font-weight: 600; margin-bottom: 20px;">Inspection Tips</h3>
            @foreach($tips as $tip)
            <div class="card mb-4" style="background-color: #ccccccff; border-radius: 10px;">
              <div class="card-body">
                <h4 class="card-title" style="font-weight: 600; color: #000000ff;">{{ $tip->title }}</h4>
                @if($tip->thumbnail)
                <img src="/thumbnails/{{ $tip->thumbnail }}" class="card-img-bottom" alt="Tip Image" style="max-width: 350px; height: auto; margin: 15px;">
                 @endif
                <p class="card-text" style="color: black;">{!! Str::limit($tip->content, 75) !!}</p>
                <a href="{{ url('inspection_tips_details', $tip->id) }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Read More</a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @include('home.footer')
  </body>
</html>

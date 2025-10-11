<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')
    <style>
      .card {
        border: none;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .form-label {
        font-size: 0.95rem;
        color: #000;
        font-weight: 550;
      }
      .form-control {
        border: 1px solid #000000ff;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        color: #000;
      }
      .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.1);
      }
      .btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
      }
        .btn-primary:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="container-fluid py-4">
        <h2 class="h5 mb-4">Edit Inspection Tip</h2>
        <div class="row justify-content-center">
          <div class="col-lg-7 col-md-9">
            <div class="card">
              <div class="card-body">
                <form action="{{url('update_inspection_tips', $tip->id)}}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                  @csrf
                  <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{$tip->title}}" required>
                    <div class="invalid-feedback">Please enter a title.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="4" placeholder="Enter content" required>{{$tip->content}}</textarea required></textarea>
                    <div class="invalid-feedback">Please enter the content.</div>
                  </div>
                <div class="mb-4">
                    <label class="form-label" for="thumbnail">Current Image</label>
                    <img src="/thumbnails/{{$tip->thumbnail}}" alt="Current Image" style="display: block; max-width: 200px; margin-top: 10px; border:#000000ff 1px solid; border-radius: 0.5rem;">
                    <div class="invalid-feedback">Please upload an image.</div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="thumbnail">Upload Image</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" style="border: none;">
                  </div>
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block"><b>Edit Tip</b></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
    <script>
      // Bootstrap validation
      (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }
              form.classList.add('was-validated')
            }, false)
          })
      })()
    </script>
  </body>
</html>

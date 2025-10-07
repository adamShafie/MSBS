<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')
    <style>
      .card {
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-radius: 1rem 1rem 0 0;
      }
      .form-label {
        font-weight: 500;
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
        <div class="row justify-content-center">
          <div class="col-lg-7 col-md-9">
            <div class="card">
              <div class="card-header">
                <h2 class="h5 mb-0">Edit Inspection Tip</h2>
              </div>
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
                    <img src="/thumbnails/{{$tip->thumbnail}}" alt="Current Image" style="display: block; max-width: 200px; margin-top: 10px;">
                    <div class="invalid-feedback">Please upload an image.</div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="thumbnail">Upload Image</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
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

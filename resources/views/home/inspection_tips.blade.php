    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Inspection Tips //</h6>
                <h1 class="mb-5">Quick Motorcycle Self-Inspection</h1>
            </div>

            <div class="row g-4">
                @foreach($tips as $tip)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="thumbnails/{{$tip->thumbnail}}" alt="Inspection Tip Image">
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">{{$tip->title}}</h5>
                            <small>{!! Str::limit($tip->content, 50) !!}</small>
                            <br><a  class="btn btn-secondary" style="margin-top: 10px;" href="{{ url('inspection_tips_details', $tip->id) }}">Tip Details</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

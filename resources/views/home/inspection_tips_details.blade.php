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
            <div class="mb-3">
            <p style="font-size: 16px; color: black;">
                🔊 You may listen to this inspection tip using the audio controls below.
            </p>

                <button class ="btn btn-success" style="background-color: #00720dff; border-color: black" onclick="playTTS()">
                    ▶ Play
                </button>

                <button class="btn btn-warning" style="border-color: black" onclick="pauseTTS()">
                    ⏸ Pause
                </button>

                <button class="btn btn-danger" style="background-color: #b90000ff; border-color: black" onclick="stopTTS()">
                    ⏹ Stop
                </button>
            </div>

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
    <script>
        let tts;
        let isPaused = false;

        function playTTS() {
            const text = `Inspection Tip.
                {{ addslashes($tip->title) }}.
                {{ addslashes(strip_tags($tip->content)) }}`;

            if (!('speechSynthesis' in window)) {
                alert('Text-to-Speech is not supported in this browser.');
                return;
            }

            // Resume if paused
            if (speechSynthesis.speaking && isPaused) {
                speechSynthesis.resume();
                isPaused = false;
                return;
            }

            // Prevent multiple speech instances
            speechSynthesis.cancel();

            tts = new SpeechSynthesisUtterance(text);
            tts.lang = 'en-US'; // change to 'ms-MY' if needed
            tts.rate = 1;
            tts.pitch = 1;

            speechSynthesis.speak(tts);
        }

        function pauseTTS() {
            if (speechSynthesis.speaking) {
                speechSynthesis.pause();
                isPaused = true;
            }
        }

        function stopTTS() {
            speechSynthesis.cancel();
            isPaused = false;
        }
    </script>

    @include('home.footer')
  </body>
</html>

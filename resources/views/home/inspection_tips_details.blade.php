<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('home.css')
    <title>Inspection Tip Details</title>
    <style>
      .card {
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 20px;
      }
      .card-title {
        font-weight: 600;
        color: #007bff;
        margin-bottom: 15px;
      }
      .card-text {
        color: #333;
        font-size: 16px;
        line-height: 1.6;
      }
      .audio-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
      }
      .audio-controls button {
        flex: 1;
        font-weight: 600;
      }
      .tip-thumbnail {
        display: block;
        margin: 0 auto 20px auto;
        max-width: 100%;
        height: auto;
        border-radius: 8px;
      }
    </style>
  </head>
  <body>
    @include('home.header')
    @include('home.sidebar')

    <div class="page-content">
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h3 class="mb-4" style="color: black; font-weight: 600;">Inspection Tip Details</h3>

            <!-- ✅ Audio controls -->
            <p style="font-size: 16px; color: black;">
              🔊 Listen to this inspection tip using the controls below:
            </p>
            <div class="audio-controls">
              <button class="btn btn-success" onclick="playTTS()" title="Play the tip">
                ▶ Play
              </button>
              <button class="btn btn-warning" onclick="pauseTTS()" title="Pause playback">
                ⏸ Pause
              </button>
              <button class="btn btn-danger" onclick="stopTTS()" title="Stop playback">
                ⏹ Stop
              </button>
            </div>

            <!-- ✅ Tip card -->
            <div class="card mb-4">
              <div class="card-body">
                <h4 class="card-title" style="color: black;">{{ $tip->title }}</h4>
                @if($tip->thumbnail)
                  <img src="/thumbnails/{{ $tip->thumbnail }}" alt="Tip Image" class="tip-thumbnail">
                @endif
                <p class="card-text">{!! $tip->content !!}</p>
              </div>
            </div>

            <!-- ✅ Back button -->
            <div class="text-center">
              <a href="{{ route('view_inspection_tips') }}" class="btn btn-secondary">
                ← Back to Tips
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ✅ TTS Script -->
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

          if (speechSynthesis.speaking && isPaused) {
              speechSynthesis.resume();
              isPaused = false;
              return;
          }

          speechSynthesis.cancel();
          tts = new SpeechSynthesisUtterance(text);
          tts.lang = 'en-US'; // change to 'ms-MY' if needed
          tts.rate = 1.3;
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

<?php
$cook_url = $video;
?>
@extends('layouts.player')

@section('content')
    <!-- Slider Start -->
    {{-- @include('layouts.part.slider_home',['slider' => null]) --}}
    <!-- <div id="embedBox" style="width:100%;max-width:100%;height:100vh;"></div> -->

    <div class="player-wrapper">
        <a href="{{ url()->previous() }}" class="playtoback"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
        @if ($cook_url)
            <div id="player" style="width:100%"></div>
        @endif
    </div>
@endsection
@push('styles')
<style>
    .makeupinstation {
        display: block;
    }

    .makeupinstation small {
        color: #9E9E9E;
        font-weight: 200;
    }

    .player-wrapper {
        width: 100%;
        height: 100vh;
        display: inline-block;
        position: relative;
    }

    .playtoback {
        position: absolute;
        top: 15px;
        z-index: -1;
        left: 15px;
    }

    .playtoback i {
        font-size: 60px;
    }

    .player-wrapper:hover .playtoback {
        z-index: 9;
    }
    @media(max-width:768px) {
#player {

}
}

</style>
@endpush
@push('scripts')
    @if ($cook_url)
        <script>
            var playerElement = document.getElementById("player");
            var player = new Clappr.Player({
                source: '<?= $cook_url ?>',
                controls: true,
                autoPlay: true,
                start: 120,
                plugins: [
                    MediaControl,
                    DashShakaPlayback,
                    LevelSelector,
                    PlaybackRatePlugin,
                ],
                exitFullscreenOnEnd: true,
                mediacontrol: {
                    buttons: "#fff"
                },
                height: "100vh",
                width: "100%",
                exitFullscreenOnEnd: false,
                poster: '<?= asset('storage/' . $mdata->featuredL->full) ?>',
                shakaConfiguration: {
                    preferredAudioLanguage: 'pt-BR',
                    streaming: {
                        rebufferingGoal: 5,
                    }
                },
                levelSelectorConfig: {
                    title: 'Quality',
                    labelCallback: function(playbackLevel, customLabel) {
                        return playbackLevel.level.height + 'p'; // High 720p
                    }
                },
                shakaOnBeforeLoad: function(shaka_player) {},
                events: {
                    onPlay: function() {
                        setTimeout(500, () => player.stop());
                    },
                }
            });
            player.attachTo(playerElement);
        </script>
    @endif
    <script>
        function loadlink() {
            var media_id = {{ $mdata->id }};
            var current_time = player.getCurrentTime();
            $.ajax({
                url: "{{ url('save/playback/media') }}",
                data: {
                    media_id: media_id,
                    current_time: current_time
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }
        loadlink();
        setInterval(function() {
            loadlink()
        }, 25000);
    </script>
@endpush

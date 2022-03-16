<?php

$cook_url = $video;

?>
@extends('layouts.player')

@section('content')
    <!-- Slider Start -->
    {{-- @include('layouts.part.slider_home',['slider' => null]) --}}
    <!-- <div id="embedBox" style="width:100%;max-width:100%;height:100vh;"></div> -->

    <div class="player-wrapper">
        <a href="{{ url()->previous() }}" class="playtoback"><i class="fa fa-long-arrow-left"
                aria-hidden="true"></i></a>
        @if ($cook_url)
            {{-- <div id="player" style="width:100%"></div> --}}

            <video id="video" width="640" poster="<?= asset('storage/' . $mdata->featuredL->full) ?>" controls
                autoplay></video>
        @endif
    </div>
@endsection
@push('scripts')
    @if ($cook_url)
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/3.2.0/shaka-player.compiled.js"></script> --}}


        <script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/3.2.0/shaka-player.ui.externs.min.js"
                integrity="sha512-jYYKs9Zf1IXxZYyQeHjiZhDDGHFbKQN8Lvtx1Tf8XefyNEEikOoMERGQ2x1lE+NPo+O9sFSho6OdPW/PYgDngQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            const manifestUri = '<?= $cook_url ?>';

            function initApp() {
                // Install built-in polyfills to patch browser incompatibilities.
                shaka.polyfill.installAll();

                // Check to see if the browser supports the basic APIs Shaka needs.
                if (shaka.Player.isBrowserSupported()) {
                    // Everything looks good!
                    initPlayer();
                } else {
                    // This browser does not have the minimum set of APIs we need.
                    // console.error('Browser not supported!');
                }
            }

            async function initPlayer() {
                // Create a Player instance.
                const video = document.getElementById('video');

                const player = new shaka.Player(video);

                const ui = video['ui'];
                const config = {
                    'overflowMenuButtons': ['quality']
                };
                ui.configure(config);


                // Attach player to the window to make it easy to access in the JS console

                window.player = player;

                // Listen for error events.
                player.addEventListener('error', onErrorEvent);

                // Try to load a manifest.
                // This is an asynchronous process.
                try {
                    await player.load(manifestUri);
                    // This runs if the asynchronous load is successful.
                    console.log('The video has now been loaded!');
                } catch (e) {
                    // onError is executed if the asynchronous load fails.
                    onError(e);
                }
            }

            function onErrorEvent(event) {
                // Extract the shaka.util.Error object from the event.
                onError(event.detail);
            }

            function onError(error) {
                // Log the error.
                console.error('Error code', error.code, 'object', error);
            }

            document.addEventListener('DOMContentLoaded', initApp);
        </script>
    @endif


    <script>
        function loadlink() {
            var media_id = {{ $mdata->id }};
            var current_time = video.currentTime;
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

@push('styles')
    <style>
        .makeupinstation {
            display: block;
        }

        .makeupinstation small {
            color: #9E9E9E;
            font-weight: 200;
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


        .player-wrapper {
            width: 100%;
            height: 100vh;
            display: inline-block;
            position: relative;

        }


        @media(max-width:515px) {
            .player-wrapper {
                width: 178%;
                transform: rotate(90deg);
                -moz-transform: rotate(90deg);
                -webkit-transform: rotate(90deg);
                -o-transform: rotate(90deg);
                -ms-transform: rotate(90deg);
                margin: 157px -147px;
                39px -127px: ;
                height: auto !important;

            }
        }

    </style>
@endpush

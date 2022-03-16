<?php

$cook_url = $video;

?>
@extends('layouts.player')

@section('content')
<a id="btn" href="{{url()->previous()}}" class="btn">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 360 216"
      >
      <path
      class="st0"
      d="M108.82,137.82h236.7c5.2,0,9.41-4.21,9.41-9.41v-43.9c0-5.2-4.21-9.41-9.41-9.41h-236.7V39
      c0-16.76-20.27-25.16-32.12-13.3L9.24,93.16c-7.35,7.35-7.35,19.26,0,26.61l67.47,67.47c11.85,11.85,32.12,3.46,32.12-13.3
      L108.82,137.82L108.82,137.82z"
      />
  </svg>
</a>
{{--  @dd($mdata->featuredL)  --}}
<player-component
v-bind:vediourl="'{{ $video }}'"
v-bind:start="'{{ $last_time->last_watchtime }}'"
v-bind:bannerurl="'<?= asset('storage/' . $mdata->featuredL->full) ?>'"
v-bind:saveurl="'<?= route('frontend.ajax.media.history') ?>'"
v-bind:mediaid="'{{ $mdata->id }}'"
>
</player-component>

@endsection
@push('scripts')

<script type="text/javascript">
    let idleTimer = null;
    let idleState = false;

    function showbtn(time) {
      clearTimeout(idleTimer);
      if (idleState == true) {
        $("#btn").removeClass("inactive");
    }
    idleState = false;
    idleTimer = setTimeout(function() {
        $("#btn").addClass("inactive");
        idleState = true;
    }, time);
}

showbtn(5000);

$(window).mousemove(function(){
    showbtn(5000);
});
</script>

@endpush

@push('styles')

<style>
body {
    margin: 0 !important;
}

.container {
    margin: 0 auto;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
    0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.max-w-full {
    max-width: 100%;
}

.w-full {
    width: 100%;
}

.h-full {
    height: 100%;
}

.video {
    position: relative;
    height: 100%;
    width: 100%;
    margin-left: 0%;
    margin-right: 0%;
}

.btn{
    position:absolute;
    z-index: 99;
}
.inactive {
    opacity: 0;
}
#btn {
    transition: opacity 0.75s ease-out;
}

</style>
@endpush

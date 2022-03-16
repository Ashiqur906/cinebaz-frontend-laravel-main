<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cinebaz</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ url('assets/frontend/images/favicon.png') }}" />
      @include('layouts.essential.css')
      <style>
         .nav-item a{
            color:white !important;
         }
      </style>
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      @include('layouts.essential.header')
        @yield('seq_content')

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="{{ url('assets/backend/js/jquery.min.js') }}"></script>
      <script src="{{ url('assets/backend/js/popper.min.js') }}"></script>
      <script src="{{ url('assets/backend/js/bootstrap.min.js') }}"></script>
      <!-- Appear JavaScript -->
      <script src="{{ url('assets/backend/js/jquery.appear.js') }}"></script>
      <!-- Countdown JavaScript -->
      <script src="{{ url('assets/backend/js/countdown.min.js') }}"></script>
      <!-- Counterup JavaScript -->
      <script src="{{ url('assets/backend/js/waypoints.min.js') }}"></script>
      <script src="{{ url('assets/backend/js/jquery.counterup.min.js') }}"></script>
      <!-- Wow JavaScript -->
      <script src="{{ url('assets/backend/js/wow.min.js') }}"></script>
      <!-- Slick JavaScript -->
      <script src="{{ url('assets/backend/js/slick.min.js') }}"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="{{ url('assets/backend/js/owl.carousel.min.js') }}"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{ url('assets/backend/js/jquery.magnific-popup.min.js') }}"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{ url('assets/backend/js/smooth-scrollbar.js') }}"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{ url('assets/backend/js/chart-custom.js') }}"></script>
      <!-- Custom JavaScript -->
      <script src="{{ url('assets/backend/js/custom.js') }}"></script>
   </body>
</html>

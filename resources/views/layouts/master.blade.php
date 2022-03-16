<!doctype html>
<html lang="en-US">

<head>
    @include('layouts.essential.seo',['seo' => isset($seo)? $seo : null])
    @include('layouts.essential.css')
    @stack('headcss')
    @stack('styles')
</head>

<body>
    <div id="app">
    </div>
    <div>

        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>
        <!-- loader END -->
        <!-- Header -->
        @include('layouts.essential.header')
        <!-- Header End -->
        @yield('content')
    </div>

    @include('layouts.essential.footer')
    @include('layouts.essential.js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function addListing(id) {
            $('.list' + id).toggleClass('active');
            $.ajax({
                url: "{{ url('frontend/ajax/listing') }}" + '/' + id,
                success: function(result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Done!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }

        function addFavorite(id) {
            $('.fev' + id).toggleClass('active');
            $.ajax({
                url: "{{ url('frontend/ajax/favorite') }}" + '/' + id,
                type: 'get',
                success: function(result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Done!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
    </script>
    <script>
        // var header = document.getElementById("mobile_active");
        //     var btns = header.getElementsByClassName("mp-list");
        //     for (var i = 0; i < btns.length; i++) {
        //     btns[i].addEventListener("click", function() {
        //     var current = document.getElementsByClassName("active");
        //     current[0].className = current[0].className.replace(" active", "");
        //     this.className += " active";
        //     });
        // }
    </script>
    <script>
        function AddToCart(id) {

            $.ajax({
                url: "{{ url('cart/add/') }}" + '/' + id,
                type: 'get',
                success: function(result) {
                    $('.cart_items').html(result);
                    setTimeout("$('.laraNoti').fadeOut('slow')", 2000);
                }
            });
        }
    </script>
    <script>
        var height = $(window).height();
        var width = $(window).width();
        console.log('Width : ' + width + 'Px');
    </script>
    @stack('scripts')
</body>

</html>

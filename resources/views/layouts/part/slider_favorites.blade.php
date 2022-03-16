@isset($slider['data'])
    @if (count($slider['data']) > 0)

        <section id="iq-favorites">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a
                                    href="javascript:void(0);">{{ isset($slider['name']) ? $slider['name'] : null }}</a>
                            </h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">

                                @foreach ($slider['data'] as $key => $value)
                                    <!-- Favorite Movie Slider Start -->
                                    @if ($value->media)
                                        @include('layouts.part.slider_cart',['sdata' => $value->media])
                                    @endif
                                    <!-- Favorite Movie Slider End -->
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endisset

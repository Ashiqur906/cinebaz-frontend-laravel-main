@isset($slider['data'])
    @if (count($slider['data']) > 0)
        @php
            foreach ($slider['data'] as $check) {
                $sug = count($check->mediaSimilar($check->video_id));
            }
        @endphp
        @if ($sug)
            <section id="iq-favorites" style="padding-top: 17px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 overflow-hidden">
                            <div class="iq-main-header d-flex align-items-center justify-content-between">

                                <h4 class="main-title"><a
                                        href="javascript:void(0);">{{ $slider['data'] && $sug && isset($slider['name']) ? $slider['name'] : null }}</a>
                                </h4>
                            </div>
                            <div class="favorites-contens">
                                <ul class="favorites-slider list-inline  row p-0 mb-0">
                                    @foreach ($slider['data'] as $key)
                                        @foreach ($key->mediaSimilar($key->video_id) as $similer)

                                            @if ($similer->media)
                                                @include('layouts.part.slider_cart',['sdata' => $similer->media])
                                            @endif

                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
@endisset

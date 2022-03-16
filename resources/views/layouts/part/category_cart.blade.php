
@isset($sdata)
    <li class="slide-item">
        <a href="{{ route('frontend.media_list', $sdata->slug) }}" class="add-banner-logo-text d-flex">
            <!-- <div class="add-logo">
            @if (isset($sdata->images) && count($sdata->images)>0)
                <img data-original="{{ isset($sdata->images[0]->small)?asset($sdata->images[0]->small):null }}" src="{{ isset($sdata->images[0]->small)?asset($sdata->images[0]->small):null }}" class="img-fluid" alt="">
            @else
                <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}" src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
            @endif
            </div> -->
            <span>{{ $sdata->title_english }}</span>
        </a>
        
    {{-- customize start --}}
    
    {{-- customize end --}}
    </li>
@endisset


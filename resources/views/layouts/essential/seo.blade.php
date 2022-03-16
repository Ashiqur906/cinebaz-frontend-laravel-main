<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name='dmca-site-verification' content='K3RvWEh2NHhCNlRkSUdaL3Z6WlI2dz090' />

<title>{{ isset($seo->meta_title) ? $seo->meta_title : 'Cinebaz Limited' }}</title>
<meta name="description" content="{{ isset($seo->meta_description) ? $seo->meta_description : null }}">
<meta name="keywords" content="{{ isset($seo->meta_keywords) ? $seo->meta_keywords : null }}">
<link rel="canonical" href="{{ isset($seo->canonical_url) ? $seo->canonical_url : null }}" />
<meta property="og:site_name" content="{{ isset($seo->meta_title) ? $seo->meta_title : null }}" />
<meta property="og:locale" content="bn_BD" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ isset($seo->meta_title) ? $seo->meta_title : null }}" />
<meta property="og:description" content="{{ isset($seo->meta_description) ? $seo->meta_description : null }}" />
<meta property="og:url" content="{{ isset($seo->seo_image) ? $seo->seo_image : null }}" />
<meta property="og:image"
    content="{{ isset($seo->seo_image) ? $seo->seo_image : url('assets/frontend/images/social.png') }}" />
<meta property="fb:pages" content="{{ null }}" />


@isset($setting['google-analytics'])
    {!! cz_setting('google-analytics') !!}
@endisset

<head>
    <base href="{{ URL::to('/') }}" />
    <title>{{ $title }} | {{ env("APP_NAME") }} </title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ env('APP_DESC') }}" />
    <meta name="keywords" content="{{ env('APP_DESC') }}, {{ env('APP_NAME') }}, Webiste, Website Rumah Sakit, Kupang, Kota Kupang, NTT, Nusa Tenggara Timur" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_TITLE') }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ env('APP_TITLE') }}" />
    <link rel="canonical" href="{{ env('APP_URL') }}" />
    <link rel="shortcut icon" href="{{ asset('template/media/logos/favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('template/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('template/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/custom/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/resetstyle.css') }}" rel="stylesheet" type="text/css" />
    <script>// {{ asset('template/-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
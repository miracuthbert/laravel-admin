<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title'){{ config('app.name') }}</title>

<!-- Fonts -->
{{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

<!-- Icons -->
<link href="{{ asset('css/icons.css') }}" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@stack('styles')

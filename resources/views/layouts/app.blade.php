<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @yield('head')
    <title>@yield('title')</title>
</head>

<body>
    <div class="container" id="main">
        <div class="my-5">
            @yield('content')
        </div>
    </div>

    <div id="cookie_query">
    </div>
    @yield('scripts')
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
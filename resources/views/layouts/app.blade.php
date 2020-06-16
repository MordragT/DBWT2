<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="user_id" content="{{ Session::get('user_id', 0) }}" />
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
    <script src="{{ asset('js/broadcasts.js') }}"></script>
</body>

</html>
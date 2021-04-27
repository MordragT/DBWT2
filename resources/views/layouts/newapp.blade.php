<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="user_id" content="{{ Session::get('user_id', 0) }}" />
    <title>@yield('title')</title>
    @yield('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="app" class="container">
        <nav-menu></nav-menu>
        <br><br>
        @yield('content')
        <br><br><br><br>
        <impressum></impressum>
        <br><br>
    </div>
    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/broadcasts.js') }}"></script>
</body>

</html>
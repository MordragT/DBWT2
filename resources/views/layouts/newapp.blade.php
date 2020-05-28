<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    @yield('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="app" class="container">
        @yield('content')
    </div>
    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>goodTable</title>
    <meta name="user_id" content="{{ Session::get('user_id', 0) }}" />
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet" />

</head>

<body>

    <div id="app">

        <vue-good-table :columns="columns" :rows="rows" max-height="300px" :fixed-header="true" :search-options="{
    enabled: true
  }">
        </vue-good-table>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/broadcasts.js') }}"></script>


</body>

</html>
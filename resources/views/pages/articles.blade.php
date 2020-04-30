@extends('layouts.app')

@section('title') Artikel @endsection

@section('scripts')
<script src="{{ asset('js/cookiecheck.js')}}"></script>
<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/warenkorb.js')}}"></script>
@endsection

@section('content')
<table class="table table-striped">
    <thead class="thead-dark">
        <tr id="table_head">
            <th class="col"> id </th>
            <th class="col"> ab_name </th>
            <th class="col"> ab_price </th>
            <th class="col"> ab_description </th>
            <th class="col"> ab_creator_id </th>
            <th class="col"> ab_createdate </th>
            <th class="col"> picture </th>
        </tr>
    </thead>

    @foreach ($articles as $article)
    <tr class="buy_object">
        <td> {{ $article->id }} </td>
        <td> {{ $article->ab_name }} </td>
        <td> {{ $article->ab_price }} </td>
        <td> {{ $article->ab_description }} </td>
        <td> {{ $article->ab_creator_id }} </td>
        <td> {{ $article->ab_createdate }} </td>


        @if (file_exists("articelpictures/$article->id.jpg"))
        <td> <img class="rounded" src="{{ asset("articelpictures/$article->id.jpg") }}" alt="{{ $article->ab_name }}"> </td>
        @else
        <td> <img class="rounded" src="{{ asset("articelpictures/$article->id.png") }}" alt="{{ $article->ab_name }}"> </td>
        @endif
    </tr>
    @endforeach
</table>

@endsection
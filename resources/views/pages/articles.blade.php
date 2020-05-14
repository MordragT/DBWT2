@extends('layouts.app')

@section('title') Artikel @endsection

@section('header')
W
<link href="{{ asset('css/articles.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div id="app">
    <input type="text" v-model="search" v-on:input="getArticles" placeholder="Suche..." class="form-control my-2">
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

        <tr v-for="article in filteredArticles" class="buy_object">
            <td> @{{ article.id }} </td>
            <td> @{{ article.ab_name }} </td>
            <td> @{{ article.ab_price }} </td>
            <td> @{{ article.ab_description }} </td>
            <td> @{{ article.ab_creator_id }} </td>
            <td> @{{ article.ab_createdate }} </td>
            <td> <img class="rounded" v-bind:src="'articelpictures/' + article.id + '.jpg'" v-bind:alt="article.ab_name"> </td>
        </tr>

    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/cookiecheck.js') }}"></script>
<script src="{{ asset('js/warenkorb.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            search: "",
            articles: []
        },
        created: function() {
            this.getArticles();
        },
        computed: {
            filteredArticles: function() {
                return this.articles.slice(0, 5);
            }
        },
        methods: {
            getArticles: function() {
                let xhr = new XMLHttpRequest();
                let query;
                if (this.search.length >= 3) {
                    query = "/api/articles?search=" + this.search;
                } else {
                    query = "/api/articles";
                }

                xhr.open("GET", query);
                xhr.onload = () => {
                    if (xhr.status == 200) {
                        this.articles = JSON.parse(xhr.response);
                        console.log(this.articles);
                    } else {
                        console.log(xhr.statusText);
                    }
                }
                xhr.send();
            }
        }
    })
</script>
@endsection
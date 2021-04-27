@extends('layouts.newapp')

@section('title') GoodTable @endsection

@section('content')
<vue-good-table :columns="columns" :rows="rows" max-height="300px" :fixed-header="true" :search-options="{
    enabled: true
  }">
</vue-good-table>
@endsection
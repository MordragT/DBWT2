@extends('layouts.newapp')

@section('title') NewSite @endsection

@section('content')
<artikel v-bind:limit-articles="5"></artikel>
@endsection
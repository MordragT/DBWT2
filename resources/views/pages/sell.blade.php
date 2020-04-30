@extends('layouts.app')

@section('title') Verkaufen @endsection

@section('scripts')
<script src="{{ asset('js/sell.js') }}"></script>
@endsection

@section('content')

@error('name')<br><br>
<p>{{ $errors->first('name') }}</p>
@enderror

@error('description')<br><br>
<p>{{ $errors->first('description') }}</p>
@enderror

@endsection
@extends('layouts.app')

@section('title') Verkaufen @endsection

@section('scripts')
<script src="{{ asset('js/sell.js') }}"></script>
@endsection

@section('content')

<h1 class="py-5">Verkaufen</h1>

@error('name')<br><br>
<p>{{ $errors->first('name') }}</p>
@enderror

@error('description')<br><br>
<p>{{ $errors->first('description') }}</p>
@enderror

@error('database')<br><br>
<p>{{ $errors->first('database') }}</p>
@enderror

@endsection
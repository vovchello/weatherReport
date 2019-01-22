@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($cities as $city)
            {{$city['name']}}
        @endforeach
    </div>
@endsection

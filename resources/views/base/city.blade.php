@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($cities as $city)
            {{dd($city)}}
            @foreach($city as $weather)
                {{$weather['city']}}
            @endforeach
        @endforeach
    </div>
@endsection

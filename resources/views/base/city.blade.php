@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($cities as $city)
            {{dd($cities)}}

        @endforeach
    </div>
@endsection

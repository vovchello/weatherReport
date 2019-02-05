@extends('layouts.app')

@section('content')
    @if(is_null($message))
        <div class="badge-warning">
            From redis
        </div>
    @endif
    <div class="container">
        @foreach($weatherList as $list)
            <div class="out" style="margin: 10px">
                <div class="card-header">
                    City: <h4>{{$list['city']['name']}}</h4>

                </div>
                <div class="bg-white">
                    Country: <h4>{{$list['city']['country']}}</h4>
                    <div class="mb-lg-auto">
                        @foreach($list['weather'] as $weather)
                                <div>
                                    {{$weather['dt_txt']}}
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

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
                    <div class="row">
                        <div class="col-3">
                            <img src="http://openweathermap.org/img/w/{{$list['weather']['weather']['0']['icon']}}.png">
                        </div>
                        <div class="col-6">
                            <>
                        </div>
                    </div>

                </div>
                <div class="bg-white">
                    <div class="mb-lg-auto">
                        {{--@foreach($list['weather'] as $weather)--}}
                                {{--<div>--}}
                                    {{--{{$weather['dt_txt']}}--}}
                                {{--</div>--}}
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

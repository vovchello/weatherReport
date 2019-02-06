@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="py-5 text-center">
            <h2>Weather forecast</h2>
            <p class="lead"></p>
        </div>

        <form action="{{route('weather')}}" method="post">
            {{csrf_field()}}
            <div class="form-group row"><label for="city" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-6">
                    <input  class="form-control" id="city" name = 'city' placeholder="Your city name" >
                </div>
                <button class="btn btn-primary mb-2" type="submit">Submit</button>
            </div>
        </form>

    </div>
    @if( !is_null($message))
        <div class="py-5 text-center">
            <h5>{{$message}}</h5>
            <p class="lead"></p>
        </div>
    @endif
    <div class="container">
        @foreach($weatherList as $list)
            <div class="out" style="margin: 10px">
                <div class="card-header">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://openweathermap.org/img/w/{{$list['weather']['weather']['0']['icon']}}.png">
                                </div>
                                <div class="col-6">
                                    {{$list['city']['name']}},{{$list['city']['country']}}
                                    <img src="http://openweathermap.org/images/flags/{{strtolower($list['city']['country'])}}.png">
                                    <b>{{$list['weather']['weather']['0']['description']}}</b>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                <div class="row">
                                    <div class="col-2">
                                        Temperature {{$list['weather']['main']['temp']}}
                                    </div>
                                    <div class="col-5">
                                        Temperature interval from {{$list['weather']['main']['temp_min']}} to {{$list['weather']['main']['temp_max']}}
                                    </div>
                                    <div class="col-4">
                                        wind {{$list['weather']['wind']['speed']}} m/s clouds {{$list['weather']['clouds']['all']}} % , {{$list['weather']['main']['pressure']}} mpa
                                    </div>
                                </div>
                                <form class ="form-row" action="{{route('refined_weather',$list['city']['id'])}}" method="get ">
                                    {{csrf_field()}}
                                    <button class="btn btn-primary mb-2" type="submit">More</button>
                                </form>

                    {{--</div>--}}
                </div>
            </div>
        @endforeach
    </div>
@endsection

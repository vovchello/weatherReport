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

        @if( !is_null($message))
            <div class="py-5 text-center">
                <h5>{{$message}}</h5>
                <p class="lead"></p>
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Description</th>
                <th scope="col">Icon</th>
                <th scope="col">Temperature, C</th>
                <th scope="col">Pressure, mpa</th>
                <th scope="col">Humidity, %</th>
            </tr>
            </thead>
            <tbody>
            @foreach($weatherList['weather'] as $weather)
                <tr>
                    <th scope="col">{{$weather['dt_txt']}}</th>
                    <th scope="col">{{$weather['weather']['0']['description']}}</th>
                    <th scope="col"><img src="https://openweathermap.org/img/w/{{$weather['weather'][0]['icon']}}.png"></th>
                    <th scope="col">{{$weather['main']['temp']}}</th>
                    <th scope="col">{{$weather['main']['pressure']}}</th>
                    <th scope="col">{{$weather['main']['humidity']}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div id="weather">
            <div class="py-5 text-center">
                <h5>{{$weather->city->name}},{{$weather->city->country}}</h5>
                <p class="lead"></p>
            </div>
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
            @foreach($weather->list as $list)
                <tr>
                    <th scope="col">{{$list->dt_txt}}</th>
                    <th scope="col">{{$list->weather['0']->description}}</th>
                    <th scope="col"><img src="https://openweathermap.org/img/w/{{$list->weather['0']->icon}}.png"></th>
                    <th scope="col">{{$list->main->temp}}</th>
                    <th scope="col">{{$list->main->pressure}}</th>
                    <th scope="col">{{$list->main->humidity}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

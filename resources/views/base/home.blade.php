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
@endsection

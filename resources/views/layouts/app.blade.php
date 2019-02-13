<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Weather Report') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Notes') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="py-5 text-center">
                <h2>Weather forecast</h2>
                <p class="lead"></p>
            </div>

            <form class="form" id="form" name="form">
                {{csrf_field()}}
                <div class="form-group row"><label for="city" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <input  class="form-control" id="city" name = 'city' placeholder="Your city name" >
                    </div>
                    <button class="btn btn-primary mb-2" type="submit">Submit</button>
                </div>
            </form>
            <div id="div" style="display: none">
                <div>
                    <a><h3></h3></a>
                    <div class="row">
                        <div class="col-1">
                            <img>
                        </div>
                        <div class="col-6">
                            <p></p>
                        </div>
                    </div>
                </div>
                </br>
            </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <script>
                    $(document).ready(function(){
                        $('#form').on('submit', function(e){
                            e.preventDefault();
                            $.ajax({
                                type: 'GET',
                                url: '/ajax/current',
                                data: $('#form').serialize(),
                                success: function(result){
                                    fillAfterRequest(result);
                                },
                                error: function(result){
                                    console.log('error');
                                    console.log(result);
                                }
                            });
                        });
                    });

                    function fillAfterRequest(list) {
                        let div = document.getElementById('div');
                        console.log(list);
                        list.weather.forEach(function(item, i, arr){
                            item = JSON.parse(item);
                            let clone = div.cloneNode(true);
                            let h3 = clone.querySelectorAll('h3');
                            let p = clone.querySelectorAll('p');
                            let img = clone.querySelectorAll('img');
                            let a = clone.querySelectorAll('a');
                            a[0].href = '/refined_weather/'+item.name+'/'+item.sys.country;
                            h3[0].innerHTML = item.name+', '+item.sys.country;
                            img[0].src = "http://openweathermap.org/img/w/"+item.weather[0].icon+".png";
                            p[0].innerHTML = 'Temperatue'+' '+item.main.temp+'degrees C, humidity '+item.main.humidity+' %, pressure'+item.main.pressure+' mpa';
                            div.parentNode.appendChild(clone);
                            clone.style.display ="";
                        });
                    }
                </script>

            <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/flick/jquery-ui.css" />
        </div>
        @yield('content')
    </main>
</div>
</body>
</html>

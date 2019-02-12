@extends('layouts.app')

@section('content')
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#form').on('submit', function(e){
                    e.preventDefault();
                    alert('sddf');
                    $.ajax({
                        type: 'GET',
                        url: '/ajax',
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
                let div;
                let container = document.createElement('div');
                let row;
                container.className = 'container';
                document.body.appendChild(container);
                list.forEach(function(item, i, arr){
                    weather = JSON.parse(item);
                    row = document.createElement("div");
                    row.className = 'row';
                    container.appendChild(row);
                    let img = $createElement('img');
                    img.src
                });
            }
        </script>

    </div>
@endsection

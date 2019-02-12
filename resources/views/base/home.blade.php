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
        <script type="text/javascript">

            jQuery(function ()
            {
                jQuery("#f_elem_city").autocomplete({
                    source: function (request, response) {
                        jQuery.getJSON(
                            "http://gd.geobytes.com/AutoCompleteCity?callback=?&q="+request.term,
                            function (data) {
                                response(data);
                            }
                        );
                    },
                    minLength: 3,
                    select: function (event, ui) {
                        var selectedObj = ui.item;
                        jQuery("#f_elem_city").val(selectedObj.value);
                        getcitydetails(selectedObj.value);
                        return false;
                    },
                    open: function () {
                        jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
                    },
                    close: function () {
                        jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                    }
                });
                jQuery("#f_elem_city").autocomplete("option", "delay", 100);
            });
        </script>
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

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/flick/jquery-ui.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <style type="text/css">
            .ui-menu .ui-menu-item a,.ui-menu .ui-menu-item a.ui-state-hover, .ui-menu .ui-menu-item a.ui-state-active {
                font-weight: normal;
                margin: -1px;
                text-align:left;
                font-size:14px;
            }
            .ui-autocomplete-loading { background: white url("/images/ui-anim_basic_16x16.gif") right center no-repeat; }
        </style>


        <form action="" method="post" name="form_citydetails" id="form_citydetails" enctype="multipart/form-data" onsubmit="return false;">
            <p><b>Please enter</b> your city here to see it work. <input class="ff_elem" type="text" name="ff_nm_from[]" value="" id="f_elem_city"/>
        </form>

    </div>
@endsection

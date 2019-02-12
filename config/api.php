<?php

return [
    'weather' =>[
        'forecast' =>[
            'uri' => 'api.openweathermap.org/data/2.5/forecast',
        ],
        'current' => [
            'uri' => 'api.openweathermap.org/data/2.5/weather',
        ],
        'query' => [
            'q' =>'' ,
            'units' => 'metric',
            'appid' => '02c10ef435d6119a32450932ac127016'
        ],
    ],
    'city' =>[
        'uri' => 'https://battuta.medunes.net/api/country/search/',
        'query' => [
            'q' =>'' ,
            'key' => '80d043d1c5040da4e2a580b67ca82785'
        ],
    ]



];

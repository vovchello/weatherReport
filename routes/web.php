<?php

Route::get('/','HomeController@index');
Route::post('weather','WeatherController@index')->name('weather');

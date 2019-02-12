<?php

Route::get('/','HomeController@index');
Route::post('weather','WeatherController@index')->name('weather');
Route::get('refined_weather/{id}','RefinedWeatherController@index')->name('refined_weather');
Route::get('ajax','AjaxController@index')->name('ajax');

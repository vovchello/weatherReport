<?php

Route::get('/','HomeController@index');
Route::get('ajax/current','AjaxController@currentWeather')->name('ajaxCurrent');
Route::get('refined_weather/{name}/{country}','WeatherController@index')->name('refined_weather');

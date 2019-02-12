<?php

Route::get('/','HomeController@index');
Route::get('ajax','AjaxController@index')->name('ajax');

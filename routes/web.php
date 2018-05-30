<?php

Route::group(['prefix' => 'api/v1'], function (){
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api/v1'], function (){


});

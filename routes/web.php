<?php

Route::group(['prefix' => 'api/v1'], function (){
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api/v1'], function (){
    //Courses routes
    Route::get('/courses', 'CourseController@index');
    Route::post('/course', 'CourseController@create');
    Route::get('/course/{id}', 'CourseController@show');
    Route::put('/course/{id}', 'CourseController@update');
    Route::delete('/course/{id}', 'CourseController@destroy');

    //Subjects routes
    Route::get('/subjects', 'SubjectController@index');
    Route::post('/subject', 'SubjectController@create');
    Route::get('/subject/{id}', 'SubjectController@show');
    Route::put('/subject/{id}', 'SubjectController@update');
    Route::delete('/subject/{id}', 'SubjectController@destroy');

});

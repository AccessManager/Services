<?php

Route::group([
    'namespace'     =>      'AccessManager\Services\Plans\Http\Controllers',
    'prefix'        =>      'services/plans',
    'middleware'    =>      'auth',
], function(){
    Route::get('/', [
        'as'    =>  'plans.index',
        'uses'  =>  'PlansController@getIndex',
    ]);

    Route::get('/add', [
        'as'    =>  'plans.add',
        'uses'  =>  'PlansController@getAdd',
    ]);

    Route::post('/add', [
        'as'    =>  'plans.add.post',
        'uses'  =>  'PlansController@postAdd',
    ]);

    Route::get('/edit/{id}', [
        'as'    =>  'plans.edit',
        'uses'  =>  'PlansController@getEdit',
    ]);

    Route::post('/edit', [
        'as'    =>  'plans.edit.post',
        'uses'  =>  'PlansController@postEdit',
    ]);

    Route::post('/delete', [
        'as'    =>  'plans.delete',
        'uses'  =>  'PlansController@postDelete',
    ]);
});
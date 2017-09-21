<?php

Route::group([
    'namespace'     =>      'AccessManager\Services\Policies\Http\Controllers',
    'prefix'        =>      'services/policies',
    'middleware'    =>      'auth',
], function(){
    Route::get('/', [
        'as'    =>  'policies.index',
        'uses'  =>  'PoliciesController@getIndex',
    ]);

    Route::get('/add', [
        'as'    =>  'policies.add',
        'uses'  =>  'PoliciesController@getAdd',
    ]);

    Route::post('/add', [
        'as'    =>  'policies.add.post',
        'uses'  =>  'PoliciesController@postAdd',
    ]);

    Route::get('/edit/{id}', [
        'as'    =>  'policies.edit',
        'uses'  =>  'PoliciesController@getEdit',
    ]);

    Route::post('/edit', [
        'as'    =>  'policies.edit.post',
        'uses'  =>  'PoliciesController@postEdit',
    ]);

    Route::post('/delete', [
        'as'    =>  'policies.delete',
        'uses'  =>  'PoliciesController@postDelete',
    ]);
});
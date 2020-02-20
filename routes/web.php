<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', function () {
        $requests = \App\Subscription::whereIn('interval',[2,3,4,5])->get();
        return view('home',['requests'=>$requests]);
    });

    Route::get('/home', function () {
        $requests = \App\Subscription::all();
        return view('home',['requests'=>$requests]);
    });



    // users routes
    Route::get('/users','UserController@manage');
    Route::post('/users','UserController@save');
    Route::post('/users/update','UserController@update');
    Route::get('/users/{id}/delete','UserController@delete');
    Route::get('/users/{id}/edit','UserController@edit');

    //subscription route
    Route::get('/subscription','SubscriptionController@index');
    Route::post('/subscription/add','SubscriptionController@save');
    Route::get('/subscription/manage','SubscriptionController@manage');
    Route::post('/subscription/{id}/update','SubscriptionController@update');
    Route::get('/subscription/{id}/delete','SubscriptionController@recycle_bin');

});


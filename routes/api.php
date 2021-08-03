<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


// to add user data like name , avatar and time
Route::post('/userData','UserController@userData');


// to add challenge
Route::post('/addChallenge','UserController@addChallenge');


// to get user profile
Route::get('/userProfile','UserController@userProfile');


// to add say
Route::post('/addSay','UserController@addSay');


// to get all says in random
Route::get('/getSay','UserController@getSay');


// to get four challenges in random
Route::get('/getFourChallenges','UserController@getFourChallenges');


// to accept challenge to do
Route::post('/acceptChallenge','UserController@acceptChallenge');


// to return all challenges for user
Route::get('/getUserChallenge','UserController@getUserChallenge');

















////  to add user image
//    Route::post('userImage','UserController@userImage');

////  to get all hours
//    Route::get('getDates','UserController@getDates');

////  to add user beginning
//    Route::post('userBeginning','UserController@userBeginning');

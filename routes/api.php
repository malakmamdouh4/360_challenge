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
Route::any('/userData','UserController@userData');



// to add user data like name , avatar and time
Route::post('/addChallenge','UserController@addChallenge');



// to get user profile
Route::get('/userProfile','UserController@userProfile');


// to get all says
Route::get('/getSay','UserController@getSay');


// to return all challenges for user
Route::get('/getUserChallenge','UserController@getUserChallenge');


// to accept challenge ( update availability from 0 to 1 )
Route::put('updateAvailable','UserController@updateAvailable');


















////  to add user image
//    Route::post('userImage','UserController@userImage');

////  to get all hours
//    Route::get('getDates','UserController@getDates');

////  to add user beginning
//    Route::post('userBeginning','UserController@userBeginning');

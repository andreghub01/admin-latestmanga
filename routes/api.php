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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('result', 'API\ResultController@all');
Route::put('result/{id}', 'API\ResultController@updateValue');
Route::get('comic', 'API\ComicController@all');
Route::put('comic/{id}', 'API\ComicController@updateDetail');
Route::get('wordpress', 'API\WordpressController@toWordpress');
Route::get('media/{id}', 'API\WordpressController@mediaToWordpress');
// Route::get('tag', 'API\WordpressController@saveTags');
Route::get('tagUpdate', 'API\WordpressController@updateTagComic');

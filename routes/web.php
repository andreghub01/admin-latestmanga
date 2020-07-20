<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/', 'CobaController@index');
Route::get('/images', 'ImageUploadController@uploadImages');
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin']) // nambahin satpamnya dr kernel
    // ->middleware(['auth', 'admin', 'verified']) // nambahin satpamnya dr kernel
    ->group(function () {

        Route::get('/', function () {
            return view('pages.dashboard');
        });
        // admin
        Route::resource('comics', 'ComicsController');
        Route::resource('webs', 'WebsController');
        Route::resource('results', 'ResultsController');
        Route::resource('tags', 'TagsController');
        // Route::resource('products', 'Store\Product\ProductsController');
        // Route::resource('gallery', 'Store\Product\GalleriesController');
        // Route::resource('document', 'Store\Product\DocumentsController');
        // Route::resource('transaction', 'Store\TransactionsController');
        // Route::get('transactionStatus', 'Store\TransactionsController@setStatus')->name('transactionStatus');
        // company profile
        // Route::resource('banners', 'CompanyProfile\BannersController');
        // Route::resource('setting', 'CompanyProfile\WebSettingController');
        // Route::resource('services', 'CompanyProfile\ServicesController');
    });




Auth::routes(['verify' => false]);

// Route::get('/admin', 'HomeController@index')->name('home');

<?php

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

Route::group(['namespace' => 'Guest'], function () {
    
    Route::group(['prefix' => '/tim-kiem'], function () {
        Route::get('/', 'HomeController@getHome')->name('guest.search.index');
        Route::get('/infomation', 'HomeController@getInformation')->name('guest_information');
        Route::get('/search', 'HomeController@searchInfomation')->name('guest_search_info');
    });
    Route::group(['prefix'=>'contact'],function(){
        Route::get('/', 'ContactController@getContact')->name('guest_contact');
        Route::post('/insert-contact', 'ContactController@postContact')->name('guest_insert_contact');
    });
    Route::group(['prefix' => 'tin-tuc'], function () {
        Route::get('/', 'NewsController@getNews')->name('guest.news.home');
        Route::get('/{slug?}', 'NewsController@getNewsDetail')->name('guest.news.detail');
        Route::get('/danh-muc/{slug?}', 'NewsController@getNewsCategory')->name('guest.news.category');
    });
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/{slug?}', 'PagesController@getPages')->name('guest_pages');
    });
    Route::group(['prefix'=>'/'],function(){
        Route::get('/','IndexController@index')->name('guest.home.index');
    });
});
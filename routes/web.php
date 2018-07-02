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

Route::group(['middleware' => ['web']], function() {
    Auth::routes();
    Route::get('/login-of-admin', 'Auth\LoginController@showLoginFormOfAdmin')->name('auth.login_of_admin');
    Route::get('/login-of-manager', 'Auth\LoginController@showLoginFormOfManager')->name('auth.login_of_manager');
    Route::get('/login-of-user', 'Auth\LoginController@showLoginFormOfUser')->name('auth.login_of_user');
    Route::post('/my-login', 'Auth\LoginController@myLogin')->name('auth.my-login');

    Route::get('/', 'SiteController@showIndex')->name('site.home');

    Route::get('/articles', 'ArticleController@showAll')->name('site.articles');
    Route::get('/articles/category/{category_slug}', 'ArticleController@showArticleOnCategory')->name('site.articles.category');
    Route::get('/article/{id}', 'ArticleController@showOne')->name('site.article');

    //<Route with middleware 'my.auth'
    Route::group(['middleware' => ['my.auth']] , function () {

        //<Route with prefix '/admin'
        Route::group(['prefix' => '/admin'] , function () {

            Route::get('/', 'Modules\Admin\SiteController@showIndex')->name('admin.site.index');

            Route::resource('/articles', 'Modules\Admin\ArticleResource');
        });
        //>Route with prefix '/admin'

    });
    //>

});
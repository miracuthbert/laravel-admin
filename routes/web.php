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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->get('/dashboard', 'DashboardController')->name('dashboard');

/**
 * Account Group Routes
 */
Route::group([
    'prefix' => '/account',
    'namespace' => 'Account',
    'as' => 'account.', 'middleware' => ['auth', 'verified']
], function () {

    /**
     * Account Overview Route
     */
    Route::get('/', 'AccountController@index')->name('index');

    /**
     * Profile Routes
     */
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@store')->name('profile.store');

    /**
     * Password Routes
     */
    Route::get('/password', 'PasswordController@index')->name('password.index');
    Route::post('/password', 'PasswordController@store')->name('password.store');
});

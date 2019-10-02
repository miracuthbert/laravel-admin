<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

/**
 * Dashboard Route
 */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

/**
 * User Namespace Routes
 */
Route::group(['namespace' => 'User'], function () {

    /**
     * Users Group Routes
     */
    Route::group(['prefix' => '/users', 'as' => 'users.'], function () {

        /**
         * Users Stats Route
         */
//        Route::get('/stats', 'UserStatsController')->name('stats.index');

        /**
         * User Group Routes
         */
        Route::group(['prefix' => '/{user}'], function () {

            /**
             * User Group Routes
             */
            Route::resource('/roles', 'UserRoleController');
        });
    });

    /**
     * Users Resource Routes
     */
    Route::resource('/users', 'UserController');
});

/**
 * Permission Namespace Routes
 */
Route::group(['namespace' => 'Permission'], function () {

    /**
     * Permissions Group Routes
     */
    Route::group(['prefix' => '/permissions', 'as' => 'permissions.'], function () {

        /**
         * Permission Status Route
         */
//        Route::post('/status', 'PermissionStatusController')->name('status');
    });

    /**
     * Permissions Resource Routes
     */
    Route::resource('/permissions', 'PermissionController');
});

/**
 * Role Namespace Routes
 */
Route::group(['namespace' => 'Role'], function () {

    /**
     * Roles Group Routes
     */
    Route::group(['prefix' => '/roles', 'as' => 'roles.'], function () {

        /**
         * Role Status Route
         */
//        Route::post('/status', 'RoleStatusController')->name('status');
    });

    /**
     * Roles Resource Routes
     */
    Route::resource('/roles', 'RoleController');
});

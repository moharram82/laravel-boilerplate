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

/**
 * Disable the registration route
 */
if(! config('auth.allow_registrations')) {
    Route::any('/register', function () {
        return redirect()->route('home');
    });
}

Route::get('/', function () {
    return view('home', ['term' => '', 'output' => []]);
})->name('home');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@home')->name('home');

    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::resource('permissions', 'PermissionController');
});

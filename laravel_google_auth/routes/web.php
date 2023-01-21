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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Google Auth
Route::get('google_redirect', 'App\Http\Controllers\GoogleAuthController@google_redirect');
Route::get('google_callback', 'App\Http\Controllers\GoogleAuthController@google_callback');
//GitHub Auth
Route::get('github_redirect', 'App\Http\Controllers\GithubAuthController@github_redirect');
Route::get('github_callback', 'App\Http\Controllers\GithubAuthController@github_callback');

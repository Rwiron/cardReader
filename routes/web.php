<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CardController;
use App\Http\Controllers\UserController;


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

// Display the registration form
Route::get('register', [CardController::class, 'showRegisterForm'])->name('register');
Route::get('/search', [UserController::class, 'index'])->name('search');
Route::get('/fetch-user/{cardInfo}', [UserController::class, 'fetchUserInfo'])->name('fetch.user.info');
// Handle the form submission

// Using the web middleware if session state is needed, otherwise consider using API routes.
// Using the web middleware if session state is needed, otherwise consider using API routes.




Route::post('register_post', [CardController::class, 'register']);
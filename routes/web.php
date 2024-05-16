<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showRegisterForm'])->name('register.show');

Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::post('quiz', [HomeController::class, 'quiz'])->name('quiz');
});

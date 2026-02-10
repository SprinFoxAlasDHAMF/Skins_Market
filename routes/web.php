<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\RegisterController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\UserPerfilController;
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

//Register
Route::get('Login/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('Login/register', [RegisterController::class, 'register'])->name('Login.register');

//Login
Route::get('Login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('Login', [LoginController::class, 'login'])->name('login.submit');
Route::post('Logout', [LoginController::class, 'logout'])->name('logout');

//Perfil
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserPerfilController::class, 'show']);
    Route::post('/perfil', [UserPerfilController::class, 'update']);
});

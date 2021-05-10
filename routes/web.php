<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    LoginController,
    UserController
};
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
Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/?keyid={$key}',[HomeController::class, 'index'])->name('home.key');
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'login'])->name('user.login');
Route::get('/minha_conta/{$id}',[UserController::class, 'index'])->name('user.minha_conta');
Route::get('/criarConta/{$id}',[UserController::class, 'criar_conta'])->name('user.criar_conta');

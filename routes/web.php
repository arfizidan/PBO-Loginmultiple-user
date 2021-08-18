<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(['web', 'auth', 'role:admin'])->group(function () {
Route::resource('akun', UserController::class);
Route::get('/dashboard', [BlogController::class, 'dashboard']);

});
Route::middleware(['web', 'auth', 'role:admin,creator'])->group(function () {

Route::resource('blog', BlogController::class);

// Route::resource('dashboard', BlogController::class);


Route::get('/delete/{id}', [BlogController::class, 'delete']);

Route::get('/hapus/{id}', [UserController::class, 'hapus']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

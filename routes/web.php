<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartoonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [MainController::class, 'index']);
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/auth', [UserController::class, 'loginForm'])->name('login');
Route::post('/auth', [UserController::class, 'login']);
Route::get('/cabinet', [UserController::class, 'cabinet'])->middleware('auth');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
//Route::get('/forms', [MainController::class, 'forms'])->middleware('auth');
Route::get('/booking',  [MainController::class, 'bookingForm'])->middleware('auth');
Route::post('/booking', [MainController::class, 'booking']);
Route::post('/questions', [MainController::class, 'questions']);
Route::middleware('auth')->group(function () {
    Route::get('/cabinet',      [UserController::class, 'cabinet']);
    Route::get('/anketa/{id}',  [MainController::class, 'anketaShow']);
    Route::get('/anketa',       [MainController::class, 'anketaForm']);
    Route::post('/anketa',      [MainController::class, 'anketaStore']);
});
 //альт ентер

//Route::post('/auth', [UserController::class, 'login'])->middleware('auth');










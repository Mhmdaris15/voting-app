<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidateController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::controller('login', LoginController::class)->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'authenticate'])->middleware('guest');
});

Route::controller('voting', [CandidateController::class, 'index'])->group(function () {
    Route::get('voting', [CandidateController::class, 'index'])->name('voting')->middleware('auth');
    // Route::post('/candidate', [CandidateController::class, 'vote']);
    Route::post('/voting/{id}', [CandidateController::class, 'vote'])->middleware('auth');
})->middleware('auth');

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

//Route::get('dashboard', function () {
//
//    return view('dashboard');
//})->middleware('auth')->name('dashboard');

Route::get('dashboard', [UserController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('dashboard', [UserController::class, 'postIndex'])->middleware('auth');
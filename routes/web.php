<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Auth::routes();

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/exchange', [CurrencyController::class, 'exchange'])->name('currency.change');
Route::get('/', [CurrencyController::class, 'welcome'])->name('welcome');

Route::middleware('auth')->group(function(){
    Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark');
    Route::get('/bookmark/list', [BookmarkController::class, 'bookmark_list'])->name('bookmark.list');
    Route::post('/bookmark/delete/{id}', [BookmarkController::class, 'bookmark_delete'])->name('bookmark.delete');
});


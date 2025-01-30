<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Auth::routes();

// Currency Convertion route
Route::get('/exchange', [CurrencyController::class, 'exchange'])->name('currency.change');

// landing page (welcome) route
Route::get('/', [CurrencyController::class, 'welcome'])->name('welcome');

// historical data for time being
Route::get('/history', [HistoryController::class, 'history_rates'])->name('history.rate');

Route::middleware('auth')->group(function(){
    Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark');
    Route::get('/bookmark/list', [BookmarkController::class, 'bookmark_list'])->name('bookmark.list');
    Route::post('/bookmark/delete/{id}', [BookmarkController::class, 'bookmark_delete'])->name('bookmark.delete');
});


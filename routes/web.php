<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 商品一覧画面へのルート
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');

// 新規登録画面へのルート、登録のルート
Route::get('/products.create', 'App\Http\Controllers\ProductController@create')->name('products.create');
Route::post('/products.store', 'App\Http\Controllers\ProductController@store')->name('products.store');

// 商品一覧画面へのルート
Route::get('/products.show/{product}', 'App\Http\Controllers\ProductController@show')->name('products.show');

// 商品編集画面へのルート、登録のルート
Route::get('/products.edit/{product}', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::put('/products.edit/{product}', 'App\Http\Controllers\ProductController@update')->name('products.update');

// 登録商品削除のルート
Route::delete('/products.destroy/{product}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');

// 検索ページ表示のルート
Route::get('/products.searchInput', 'App\Http\Controllers\ProductController@searchInput')->name('products.searchInput');


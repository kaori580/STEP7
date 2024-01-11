<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//商品情報画面のルーティング
Route::get('/list', [App\Http\Controllers\ProductsController::class, 'showList'])->name('list');

// 商品情報新規登録画面のルーティング（表示）
Route::get('/regist', [App\Http\Controllers\ProductsController::class, 'regist'])->name('regist');
// 商品情報新規登録画面送信ボタンのルーティング（処理）
Route::post('/registSubmit',[App\Http\Controllers\ProductsController::class, 'registSubmit'])->name('submit');

//詳細画面の表示ルーティング
Route::get('/detail/{id}', [App\Http\Controllers\ProductsController::class, 'showDetail'])->name('detail');

// //編集画面
Route::get('/detail/edit/{id}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('edit');

// 編集アップデート
Route::post('/detail/update/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('update');

// 検索機能のルーティング
Route::get('/search', [App\Http\Controllers\ProductsController::class, 'showList'])->name('search');

// 削除ボタンのルーティング
Route::post('/list/delete/{id}', [App\Http\Controllers\ProductsController::class, 'exeDelete'])->name('delete');

//商品情報画面の検索ルーティング
// Route::post('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('detail');


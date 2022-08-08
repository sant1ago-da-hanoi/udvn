<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

        Route::prefix('/categories')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');

            Route::get('/show/{slug}', [CategoryController::class, 'show'])->name('detail');

            Route::get('/create', [CategoryController::class, 'create'])->name('create');

            Route::delete('/delete', [CategoryController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/products')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/show/{slug}', [ProductController::class, 'show'])->name('detail');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/create', [ProductController::class, 'store'])->name('store');
        });
    });

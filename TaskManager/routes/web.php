<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [MainController::class, 'home'])->name('home');
Route::name('auth.')->group(function () {
    Route::post('/register', [MainController::class, 'processRegister'])->name('register');
    Route::post('/login', [MainController::class, 'processLogin'])->name('login');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect(route('home'));
    })->name('logout');
});

Route::name('user.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->middleware('auth')->name('profile');
    Route::post('/profile/edit', [ProfileController::class, 'profileEdit'])->middleware('auth')->name('profileEdit');
});

Route::name('shop.')->group(function () {
    Route::get('/shop', [ShopController::class, 'shopList'])->name('main');
    Route::get('/history', [ShopController::class, 'showHistory'])->name('history');
    Route::get('/item/{id}', [ShopController::class, 'showItem'])->name('showItem');
    Route::get('/addItem', function () {
        return view('shop_layouts.addItem');
    })->middleware('auth')->name('addItem');
    Route::post('/addItem', [ShopController::class, 'addItem'])->middleware('auth')->name('addItem');
    Route::get('/buyItem/{id}', [ShopController::class, 'buyItem'])->middleware('auth')->name('buyItem');
    Route::post('/addComment/{itemId}', [ShopController::class, 'addComment'])->middleware('auth')->name('addComment');
});


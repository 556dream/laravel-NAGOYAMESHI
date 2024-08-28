<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\SubscriptController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;

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

Route::middleware(['auth'])->group(function () {
    Route::resource('shops', ShopController::class);

    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('favorites/{shop_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{shop_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});


Route::get('users/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('users/review/{review}/edit', [ReviewController::class, 'edit'])->name('review.edit');
Route::put('users/review/{review}', [ReviewController::class, 'update'])->name('review.update');
Route::delete('users/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store');

Route::get('users/reserve', [ReserveController::class, 'index'])->name('reserve.index');
Route::get('users/reserve/{reservation}/edit', [ReserveController::class, 'edit'])->name('reserve.edit');
Route::put('users/reserve/{reservation}', [ReserveController::class, 'update'])->name('reserve.update');

Route::delete('users/reserve/{reservation}', [ReserveController::class, 'destroy'])->name('reserve.destroy');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/upadte', 'premium_delete')->name('mypage.premiumdelete');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
});



Route::controller(SubscriptController::class)->middleware('auth')->group(function () {
    Route::get('subscript/', 'index')->name('subscript.index');
    Route::post('subscript/', 'register')->name('subscript.register');
    Route::get('subscript/edit', 'edit')->name('subscript.edit');    
    Route::post('subscript/edit', 'update')->name('subscript.update');
    Route::get('subscript/cancel', 'cancel_confirm')->name('subscript.cancel_confirm');    
    Route::post('subscript/cancel', 'cancel')->name('subscript.cancel');
});

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();
    return Redirect::to('/login');
})->name('logout');
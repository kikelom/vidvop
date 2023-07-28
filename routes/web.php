<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;

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
    if (Auth::check()){
        return redirect('home');
    }else{
        return view('auth.login');
    }
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Registration Routes
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

// User Login Routes
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

// User Logout Route
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {
    // Routes that require authentication go here
    Route::prefix('video')->group(function(){
        Route::get('/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/store', [VideoController::class, 'store'])->name('video.store');
        Route::get('/', [VideoController::class, 'index'])->name('video.index');
        Route::post('/{video}/comment', [CommentController::class, 'store'])->name('comment.store');
        Route::post('/{video}/rating', [RatingController::class, 'store'])->name('rating.store');
    });
});



// Route::group(['middleware' => 'creator'], function () {
//     // Routes accessible to creators only
//     Route::prefix('video')->group(function(){
//         Route::get('/create', [VideoController::class, 'create'])->name('video.create');
//         Route::post('/store', [VideoController::class, 'store'])->name('video.store');
//     });
// });

// Route::group(['middleware' => 'consumer'], function () {
//     // Routes accessible to consumers only
//     Route::prefix('video')->group(function(){
//         Route::get('/', [VideoController::class, 'index'])->name('video.index');
//         Route::post('/{video}/comment', [CommentController::class, 'store'])->name('comment.store');
//         Route::post('/{video}/rating', [RatingController::class, 'store'])->name('rating.store');
//     });
// });

// Route::group(['middleware' => 'admin'], function () {
//     // Routes accessible to creators only
//     Route::prefix('video')->group(function(){
//         Route::get('/create', [VideoController::class, 'create'])->name('video.create');
//         Route::post('/store', [VideoController::class, 'store'])->name('video.store');
//         Route::get('/', [VideoController::class, 'index'])->name('video.index');
//         Route::post('/{video}/comment', [CommentController::class, 'store'])->name('comment.store');
//         Route::post('/{video}/rating', [RatingController::class, 'store'])->name('rating.store');
//     });
// });





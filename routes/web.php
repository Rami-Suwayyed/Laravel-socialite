<?php

use App\Http\Controllers\Auth\SocialiteloginController;
use App\Http\Controllers\SocialiteController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/auth/{provider}/redirect', [SocialiteloginController::class,'redirect'])->name('auth.socialite.redirect');
Route::get('/auth/{provider}/collback', [SocialiteloginController::class,'collback'])->name('auth.socialite.collback');

Route::get('/auth/{provider}/user', [SocialiteController::class,'index']);

require __DIR__.'/auth.php';

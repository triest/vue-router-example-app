<?php

use App\Http\Controllers\AnketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    Route::post('register', [RegisterController::class ,'register']);
    Route::post('login', [LoginController::class ,'login']);
});

Route::middleware('auth')->group(
        function () {
            Route::resource('products', ProductController::class);
            Route::resource('settings', SettingController::class);
            Route::apiResource('profile', ProfileController::class);
            Route::apiResource('search', SearchController::class);
            Route::post('/profile/main-photo/upload', [ProfileController::class, 'uploadMainPhoto']);
            Route::get('/anket/:unique_id',[AnketController::class,'show']);
        }
);



Route::get('/test',function (){
    $user=User::select(['*'])->with('relation')->first();
        dump($user);

    $relation=\App\Models\Relations::select(['*'])->with('user')->first();
    dump($relation);
});

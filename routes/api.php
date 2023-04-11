<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
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
Route::post('login',[AuthenticationController::class,'login']);
Route::post('register',[AuthenticationController::class,'register']);

Route::apiResources([
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'languages' => LanguageController::class,
    'authors' => AuthorController::class,
],['only'=>['index','show']]);

Route::middleware(['auth:sanctum','admin'])->group(function(){
    Route::apiResources([
        'books' => BookController::class,
        'categories' => CategoryController::class,
        'languages' => LanguageController::class,
        'authors' => AuthorController::class,

    ],['except'=>['index','show']]);

});
<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

//authentication

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

//public singls 

Route::get('books/stars/{book}', [BookController::class, 'getBookReviewsRate']);
Route::get('books/orders/{book}', [BookController::class, 'bookOrders']);

//public resources

Route::apiResources([
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'languages' => LanguageController::class,
    'authors' => AuthorController::class,
], ['only' => ['index', 'show']]);

// auth

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('carts', CartController::class)->except(['show']);
    Route::post('', [CartController::class, 'checkout']);
    Route::apiResource('reviews', ReviewController::class)->except(['show', 'index']);
    Route::apiResource('users', UserController::class)->only(['show', 'update', 'delete']);
});

//admin auth

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResources([
        'books' => BookController::class,
        'categories' => CategoryController::class,
        'languages' => LanguageController::class,
        'authors' => AuthorController::class,
    ], ['except' => ['index', 'show']]);
    Route::apiResource('users', UserController::class)->only('index');
});

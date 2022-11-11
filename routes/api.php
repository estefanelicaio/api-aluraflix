<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\VideoController;
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

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {

    Route::apiResource('/videos', VideoController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::get('/categories/{id}/videos', [CategoryController::class, 'findVideosByCategoryId'])->name('categories.videos');
});

Route::get('/free-videos', [VideoController::class, 'free'])->name('videos.free');

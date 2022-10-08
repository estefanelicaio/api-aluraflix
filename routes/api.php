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

Route::middleware('auth:sanctum')->group(function() {

    Route::apiResource('/videos', VideoController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::get('/categories/{id}/videos', [CategoryController::class, 'get_videos_by_category_id'])->name('categories.videos');
});

Route::post('/login', [LoginController::class, 'login']);

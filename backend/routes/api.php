<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/videos', [VideosController::class, 'index']);
    Route::get('/paginate-videos', [VideosController::class, 'paginateVideo']);
    Route::post('/create-video', [VideosController::class, 'saveVideo']);
    Route::get('/video/{id}', [VideosController::class, 'getVideoId']);

    Route::post('/comments', [CommentsController::class, 'store']);
    Route::delete('/delete-comments/{id}', [CommentsController::class, 'deleteComments']);

    Route::post('/logout', [LogoutController::class, 'logout']);
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

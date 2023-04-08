<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProfileController;

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

Route::prefix('auth')->group(function () {
    Route::post('/send_signup_otp',  [AuthController::class, 'sendOtp']);
    Route::post('/create_admin',  [AuthController::class, 'createAdmin']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/get_invitation_code', [AuthController::class, 'generateInvitationKey']);
    });

    Route::post('/admin_login', [AuthController::class, 'adminLogin']);
    Route::post('/user_register', [AuthController::class, 'signUp']);
    Route::post('/user_login', [AuthController::class, 'userLogin']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('create_movie_record', [AdminController::class, 'postMovie']);
    Route::get('/movies/catalogue/{catalogue}', [ProfileController::class, 'showByCatalogue']);

    Route::post('create_news_record', [AdminController::class, 'postNews']);
    Route::put('update_news_record/{$id}', [AdminController::class, 'updateNews']);
    Route::delete('delete_news_record/{$id}', [AdminController::class, 'destroyNews']);
    Route::get('/news', [ProfileController::class, 'indexNews']);
});

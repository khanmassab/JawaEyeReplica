<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\BusinessController;

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
    Route::post('/password/otp', [AuthController::class, 'generateOtp']);
    Route::post('/password/change', [AuthController::class, 'verifyOtpAndChangePassword']);
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

    Route::post('/user/profile_picture', [ProfileController::class, 'uploadProfilePicture']);
    Route::delete('/user/delete/profile_picture', [ProfileController::class, 'deleteProfilePicture']);

    Route::post('/admin/ad/create', [AdminController::class, 'postAdvertisement']);
    Route::delete('/admin/ad/delete/{id}', [AdminController::class, 'deleteAd']);
    Route::get('/user/ad/index', [ProfileController::class, 'indexAd']);
    
    Route::post('/admin/service/create', [AdminController::class, 'postService']);
    Route::post('/admin/notification/create', [AdminController::class, 'postNotification']);
    Route::delete('/admin/service/delete/{id}', [AdminController::class, 'deleteService']);
    Route::get('/user/service/index', [ProfileController::class, 'indexService']);
    
    Route::post('/user/recharge', [BusinessController::class, 'recharge']);
    Route::post('/user/withdrawal', [BusinessController::class, 'withdrawal']);

    Route::post('/admin/recharge/approve/{id}', [AdminController::class, 'approveRecharge']);
    Route::post('/admin/recharge/decline/{id}', [AdminController::class, 'declineRecharge']);
    Route::post('/admin/withdrawal/approve/{id}', [AdminController::class, 'approveWithdrawal']);
    Route::post('/admin/withdrawal/decline/{id}', [AdminController::class, 'declineWithdrawal']);

    Route::get('/user/notification/index', [ProfileController::class, 'indexNotification']);
    Route::post('/user/wallet/add', [BusinessController::class, 'addWallet']);


    Route::get('/user/account/history', [BusinessController::class, 'accountHistory']);
    Route::get('/user/account/balance', [BusinessController::class, 'checkBalance']);
    Route::post('/user/buy/ticket/{movieId}', [BusinessController::class, 'buyTicket']);
});

<?php


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ChangeUserPasswordController;
use App\Http\Controllers\User\UserProfileController;
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
Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('userProfileUpdate', UserProfileController::class);
        Route::post('changeUserPassword', ChangeUserPasswordController::class);
    });


    Route::middleware(['guest:sanctum'])->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
        Route::post('forgotPasswordUser',ForgotPasswordController::class);
    });
});



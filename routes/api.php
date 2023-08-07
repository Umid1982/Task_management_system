<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
        
    });


    Route::middleware(['guest:sanctum'])->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
    });
});



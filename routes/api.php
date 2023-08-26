<?php


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\User\ChangeUserPasswordController;
use App\Http\Controllers\User\RoleController;
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

        Route::post('logout', LogoutController::class);

        Route::post('userProfileUpdate', UserProfileController::class);

        Route::post('changeUserPassword', ChangeUserPasswordController::class);
        Route::post('create_role_for_user/{user}', [RoleController::class, 'createRole']);
        Route::post('create_permission_for_user/{user}', [RoleController::class, 'createPermission']);
        // TEAM CRUD
        Route::post('participant_team', [TeamController::class, 'participantTeam']);
        Route::resource('teams', TeamController::class);
        //PROJECT CRUD
        Route::resource('projects', ProjectController::class);
        //COMMENT CRUD FOR TASK
        Route::post('comment', [CommentTaskController::class,'sedComment']);
        Route::resource('comments', CommentTaskController::class)->parameters(['comments' =>'commentTask']);
        //TASK CRUD
        Route::post('task_users', [TaskController::class, 'taskUsers']);
        Route::resource('tasks', TaskController::class);
    });


    Route::middleware(['guest:sanctum'])->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
        Route::post('forgotPasswordUser', ForgotPasswordController::class);
    });

});



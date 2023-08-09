<?php

namespace App\Http\Controllers\Auth;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;


class ForgotPasswordController extends Controller
{
    public function __construct( protected readonly AuthService $authService)
    {

   }

    public function __invoke(ForgotPasswordRequest $forgotPasswordRequest)
    {
        $user = $this->authService->forgotPassword(
            $forgotPasswordRequest->get('email'),
        );
        return response([
            'data' => UserResource::make($user),
            'message' => UserResponseEnum::USER_PASSWORD_NEW,
            'success' => true,
        ]);
   }
}

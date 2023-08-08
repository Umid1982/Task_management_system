<?php

namespace App\Http\Controllers\Auth;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class LoginController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(LoginRequest $loginRequest)
    {
        $token = $this->authService->login(
            $loginRequest->get('email'),
            $loginRequest->get('password')
        );

        return response([
            'data' => AuthResource::make(['user' => auth()->user(), 'token' => $token]),
            'message' => UserResponseEnum::USER_REGISTER,
            'success' => true
        ]);
    }
}

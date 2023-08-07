<?php

namespace App\Http\Controllers\Auth;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest)
    {
        try {
            $user = User::query()->where('email', '=', $loginRequest->email)->firstOrFail();
            $token = $user->createToken('my_api_token')->plainTextToken;
            return response([
                'data' => AuthResource::make(['user' => $user,'token'=>$token]),
                'success' => UserResponseEnum::USER_REGISTER,
            ]);
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'success' => false
            ]);
        }
    }
}

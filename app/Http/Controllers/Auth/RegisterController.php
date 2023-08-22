<?php

namespace App\Http\Controllers\Auth;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Mail\User\PasswordMail;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class RegisterController extends Controller
{
    public function __construct(protected readonly AuthService $authService)
    {

    }
/**
 *@throws  \Exception
 */
    public function __invoke(RegisterRequest $registerRequest)
    {
        $user = $this->authService->register(
            $registerRequest->get('name'),
            $registerRequest->get('email')
        );
        return response([
            'data' => AuthResource::make(['user' => $user]),
            'message' => UserResponseEnum::USER_REGISTER,
            'success' => true,
        ]);
    }
}

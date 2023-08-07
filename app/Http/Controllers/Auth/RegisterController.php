<?php

namespace App\Http\Controllers\Auth;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $registerRequest)
    {
        try {
            $user = User::query()->create([
                'name' => $registerRequest['name'],
                'email' => $registerRequest['email'],
                'password' => bcrypt($registerRequest['password']),
            ]);
            $password = Str::random(10);
            Mail::to($user['email'])->send(new PasswordMail($password));

            return response([
                'data' => AuthResource::make(['user' => $user]),
                'success' => UserResponseEnum::USER_REGISTER,
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'success' => false
            ]);
        }
    }
}

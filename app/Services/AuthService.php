<?php

namespace App\Services;

use App\Events\SendPassword;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

class AuthService
{
    /**
     * @throws \Exception
     */
    public function login(
        string $email,
        string $password
    ): string
    {
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            /** @var User $user */
            $user = \auth()->user();

            if (is_null($user->email_verified_at)) {
                $user->update(['email_verified_at' => now()]);
            }
            /** @var Activity  $userAuth */
            $userAuth = auth()->user();
            activity($userAuth->email)->log('user logged in');
            return auth()->user()->createToken('auth-token')->plainTextToken;
        }

        throw new \Exception('Введенные данные не правильные!');
    }

    public function register(string $name, string $email): Model|Builder
    {
        /** @var User $password */
        $password = Str::password(8);

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        event(new SendPassword($user->email, $password));

        return $user;
    }

    public function forgotPassword(string $email): User
    {
        /** @var User $user */
        $password = Str::random(8);
        $user = User::query()->where('email', '=', $email)->first();

        $user->update([
            'password' => bcrypt($password)
        ]);

        Mail::to($user['email'])->send(new PasswordMail($password));
        $user->tokens()->delete();

        return $user;
    }
}

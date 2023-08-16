<?php

namespace App\Services;

use App\Mail\User\PasswordMail;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;
use Illuminate\Contracts\Encryption\DecryptException;

class UserProfileService
{
    /** @throws \Exception */
    public function profileUpdate(string|null $name, string|null $email, $media): User
    {
        /** @var User $user */

        $user = Auth::user();
        if ($media) {
            $user->clearMediaCollection('avatar');
            $user->addMedia($media)->toMediaCollection('avatar');
        }
        if (!is_null($email)) {
            $user->update([
                'email' => $email,
            ]);
            $user = User::query()->where('email', '=', $email)->first();
            $password = \Illuminate\Support\Str::random(8);
            $user->update([
                'password' => bcrypt($password)
            ]);
            Mail::to($user['email'])->send(new PasswordMail($password));
            $user->tokens()->delete();

        } elseif (!is_null($name)) {
            $user->update([
                'name' => $name,
            ]);
        }
        return $user;
    }

    public function changeUserPassword(string $password, string $new_password)
    {
        /** @var User $user */
        $user = Auth::user();

        if (Hash::check($password, $user->password)) {
            $user->update([
                'password' => bcrypt($new_password),
            ]);
            $user->tokens()->delete();
            return $user;
        }
        return false;
    }
}

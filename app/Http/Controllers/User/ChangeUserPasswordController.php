<?php

namespace App\Http\Controllers\User;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\UserResource;
use App\Services\UserProfileService;
use Illuminate\Routing\Controller;


class ChangeUserPasswordController extends Controller
{
    public function __construct(protected readonly UserProfileService $userProfileService)
    {

    }

    public function __invoke(ChangePasswordRequest $changePasswordRequest)
    {
        $changeOldPassword = $this->userProfileService->changeUserPassword(
            $changePasswordRequest->get('password'),
            $changePasswordRequest->get('new_password'),
        );

        if($changeOldPassword) {
            return response([
                'data' => UserResource::make($changeOldPassword),
                'message' => UserResponseEnum::USER_PASSWORD_CHANGE,
                'success' => true,
            ]);
        };

        return response([
            'message' => 'Password incorrect!',
            'success' => false
        ]);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __construct(protected readonly UserProfileService $userProfileService)
    {

    }

    public function __invoke(UserProfileRequest $userProfileRequest)
    {
        $userProfile = $this->userProfileService->profileUpdate(
            $userProfileRequest->get('name'),
            $userProfileRequest->get('email'),
            $userProfileRequest->file('media'),
        );

        return response([
            'data' => UserProfileResource::make($userProfile),
            'message' => UserResponseEnum::USER_UPDATED,
            'success' => true
        ]);
    }
}

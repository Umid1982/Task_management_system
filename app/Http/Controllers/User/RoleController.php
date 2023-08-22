<?php

namespace App\Http\Controllers\User;

use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRole\UpdateRequest;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserRoleService;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct(protected readonly UserRoleService $userRoleService)
    {
    }

    public function createRole(UpdateRequest $updateRequest, User $user)
    {

        $data = $this->userRoleService->createRole(
            $updateRequest->get('name'),
            $updateRequest->get('email'),
            $updateRequest->get('role_name'),
            $user
        );
        return response([
            'data' => UserResource::make($data),
            'role_name' => $updateRequest->role_name,
            'message' => UserResponseEnum::USER_ROLE_CREATE,
            'success' => true
        ]);
    }

    public function createPermission(StoreRequest $request, User $user)
    {
         $this->userRoleService->savePermission(
            $request->get('role_name'),
            $request->get('permission_id'),
            $user
        );
        return response([
            'data' => UserResource::make($user),
            'message' => UserResponseEnum::USER_PERMISSION_CREATE,
            'success' => true
        ]);
    }
}

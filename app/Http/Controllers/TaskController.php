<?php

namespace App\Http\Controllers;

use App\Console\Constants\ResponseConstants\TaskResponseEnum;
use App\Console\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Requests\Task\TaskDependenciesRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Requests\TaskUser\StoreRequest;
use App\Http\Requests\TaskUser\UserTaskTimeStoreRequest;
use App\Http\Resources\TaskChildrenResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskUserResource;
use App\Http\Resources\UserTaskTimeResource;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected readonly TaskService $taskService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->taskService->taskList();
        return response([
            'data' => TaskResource::collection($data),
            'message' => TaskResponseEnum::TASK_LIST,
            'success' => true
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\Task\StoreRequest $storeRequest)
    {
        $data = $this->taskService->storeTask(
            $storeRequest->get('title'),
            $storeRequest->get('description'),
            $storeRequest->get('status'),
            $storeRequest->get('priority'),
            $storeRequest->get('expired_at'),
            $storeRequest->get('user_id'),
        );

        return response([
            'data' => TaskResource::make($data),
            'message' => TaskResponseEnum::TASK_STORE,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if (auth()->user()->hasPermissionTo('show')) {
            return response([
                'data' => TaskResource::make($task),
                'message' => TaskResponseEnum::TASK_SHOW,
                'success' => true
            ]);
        }
        return response([
            'message' => TaskResponseEnum::ERROR,
            'success' => false
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, Task $task)
    {
        $data = $this->taskService->updateTask(
            $updateRequest->get('title'),
            $updateRequest->get('description'),
            $updateRequest->get('status'),
            $updateRequest->get('priority'),
            $updateRequest->get('expired_at'),
            $updateRequest->get('user_id'),
            $task
        );

        return response([
            'data' => TaskResource::make($data),
            'message' => TaskResponseEnum::TASK_UPDATE,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $isSuccess = $this->taskService->delete($task);

        if (!$isSuccess) {
            return response([
                'message' => TaskResponseEnum::TASK_DELETE_FAILED,
                'success' => false,
            ]);
        }

        return response([
            'message' => TaskResponseEnum::TASK_DELETE,
            'success' => true
        ]);
    }

    public function taskUsers(StoreRequest $storerequest)
    {
        $data = $this->taskService->createTaskUsers(
            $storerequest->get('task_id'),
            $storerequest->get('user_id'),
        );
        return response([
            'data' => TaskUserResource::make($data->load('task')->load('user')),
            'message' => TaskResponseEnum::TASK_USER_CREATE,
            'success' => true
        ]);
    }

    public function userTaskTime(UserTaskTimeStoreRequest $request)
    {
        $data = $this->taskService->userTaskTime(
            $request->get('user_id'),
            $request->get('task_id'),
            $request->get('start_time'),
            $request->get('end_time'),
        );
        return response([
            'data' => UserTaskTimeResource::make($data->load('user')->load('task')),
            'message' => UserResponseEnum::USER_TASK,
            'success' => true,
        ]);
    }

    public function taskDependencies(TaskDependenciesRequest $request, Task $task)
    {
        $data = $this->taskService->dependencie(
            $request->get('status'),
            $task
        );

        return response([
            'data' => TaskChildrenResource::make($data->load('children')),
            'message' => TaskResponseEnum::TASK_CHILDREN,
            'success' => true,
        ]);

    }


}

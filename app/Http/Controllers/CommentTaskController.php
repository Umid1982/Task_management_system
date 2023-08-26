<?php

namespace App\Http\Controllers;

use App\Console\Constants\ResponseConstants\CommentResponseEnum;
use App\Http\Requests\Comment\SendRequest;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\CommentTaskResource;
use App\Models\CommentTask;
use App\Services\Comment\CommentService;

class CommentTaskController extends Controller
{
    public function __construct(protected readonly CommentService $commentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->commentService->commentList();
        return response([
            'data' => CommentTaskResource::collection($data->load('user')->load('task')),
            'message' => CommentResponseEnum::COMMENT_LIST,
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $data = $this->commentService->storeComment(
            $storeRequest->get('comment'),
            $storeRequest->get('task_id'),
        );
        return response([
            'data' => CommentTaskResource::make($data->load('user')->load('task')),
            'message' => CommentResponseEnum::COMMENT_STORE,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentTask $commentTask)
    {
        if (auth()->user()->hasPermissionTo('show')) {
            return response([
                'data' => CommentTaskResource::make($commentTask->load('user')->load('task')),
                'message' => CommentResponseEnum::COMMENT_SHOW,
                'success' => true
            ]);
        }
        return response([
            'message' => CommentResponseEnum::ERROR,
            'success' => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, CommentTask $commentTask)
    {
        $data = $this->commentService->updateComment(
            $updateRequest->get('comment'),
            $updateRequest->get('task_id'),
            $commentTask
        );
        return response([
            'data' => CommentTaskResource::make($data->load('user')->load('task')),
            'message' => CommentResponseEnum::COMMENT_UPDATE,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentTask $commentTask)
    {
        $isSuccess = $this->commentService->delete($commentTask);

        if (!$isSuccess) {
            return response([
                'message' => CommentResponseEnum::COMMENT_DELETE_FAILED,
                'success' => false,
            ]);
        }

        return response([
            'message' => CommentResponseEnum::COMMENT_DELETE,
            'success' => true
        ]);
    }

    public function sedComment(SendRequest $sendRequest)
    {
        $data = $this->commentService->send(
            $sendRequest->get('comment'),
            $sendRequest->get('user_id'),
            $sendRequest->get('task_id')
        );
        return response([
            'data' => CommentTaskResource::make($data->load('user')->load('task')),
            'message' => CommentResponseEnum::COMMENT_SEND,
            'success' => true
        ]);
    }
}

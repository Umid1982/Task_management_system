<?php

namespace App\Http\Controllers;

use App\Console\Constants\ResponseConstants\StatisticalResponseEnum;
use App\Http\Resources\StatisticalProjectTaskResource;
use App\Services\StaticsProjectTaskService;
use Illuminate\Http\Request;

class StaticsProjectTaskController extends Controller
{
    public function __construct(protected readonly StaticsProjectTaskService $staticsProjectTaskService)
    {
    }

    public function __invoke()
    {
        $data = $this->staticsProjectTaskService->statisticalList();
        return response([
            'data' => StatisticalProjectTaskResource::collection($data),
            'message' => StatisticalResponseEnum::STATISTICAL_LIST,
            'success' => true
        ]);

    }
}

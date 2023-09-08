<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTaskTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'start_time'=>$this['start_time'],
            'end_time'=>$this['end_time'],
            'user_id' => UserResource::make($this->whenLoaded('user')),
            'task_id' => TaskResource::make($this->whenLoaded('task')),
        ];
    }
}

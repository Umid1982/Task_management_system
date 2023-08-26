<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'comment' => $this->comment,
            'user'=>UserResource::make($this->whenLoaded('user')),
            'task'=>TaskResource::make($this->whenLoaded('task'))
        ];
    }
}

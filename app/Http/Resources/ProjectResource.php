<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this['id'],
            'title'=>$this['title'],
            'description'=>$this['description'],
            'status_date'=>$this['status_date'],
            'team_id'=>$this['team_id']
        ];
    }
}
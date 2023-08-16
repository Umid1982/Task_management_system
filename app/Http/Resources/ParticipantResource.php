<?php

namespace App\Http\Resources;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property-read TeamUser $teamUser
 */
class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'team' => TeamResource::make($this->whenLoaded('team')),
        ];
    }
}

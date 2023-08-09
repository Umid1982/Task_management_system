<?php

namespace App\Http\Resources;

use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this['name'],
            'email' => $this['email'],
            'avatar' => $this->getFirstMediaUrl('avatar'),
        ];
    }
}

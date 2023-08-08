<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'user' => UserResource::make($this['user']),
        ];

        if (isset($this['token'])) {
            $response['token'] = $this['token'];
        }

        return $response;
    }
}

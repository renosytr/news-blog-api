<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->writter->uuid,
            'first_name' => $this->writter->first_name,
            'last_name' => $this->writter->last_name,
            'avatar' => $this->writter->avatar
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->reader->uuid,
            'first_name' => $this->reader->first_name,
            'last_name' => $this->reader->last_name,
            'avatar' => $this->reader->avatar
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'comment_content' => $this->comment_content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'reader' => [
                'uuid' => $this->reader->uuid,
                'first_name' => $this->reader->first_name,
                'last_name' => $this->reader->last_name,
                'avatar' => $this->reader->avatar
            ]
        ];
    }
}

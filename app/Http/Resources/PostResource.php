<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'post_content' => $this->post_content,
            'summary' => $this->summary,
            'slug' => $this->slug,
            'cover' => $this->cover,
            'tags' => $this->tags,
            'category' => [
                'uuid' => $this->category->uuid,
                'name' => $this->category->name,
                'icon' => $this->category->icon
            ],
            'writter' => [
                'uuid' => $this->writter->uuid,
                'first_name' => $this->writter->first_name,
                'last_name' => $this->writter->last_name,
                'avatar' => $this->writter->avatar,
                'summary' => $this->writter->summary,
                'mobile' => $this->writter->mobile,
                'facebook' => $this->writter->facebook,
                'twitter' => $this->writter->twitter,
                'instagram' => $this->writter->instagram,
                'linkedin' => $this->writter->linkedin
            ],
        ];
    }
}

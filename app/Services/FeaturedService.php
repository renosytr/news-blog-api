<?php

namespace App\Services;
use App\Models\post;
use App\Models\writter;
use App\Models\User;
use App\Http\Resources\PostResource;
use App\Http\Resources\WritterResource;

class FeaturedService
{
    public function getFeaturedPost()
    {
        $post = post::where('deleted_at', null)->where('is_featured', true)->orderBy('created_at','desc')->with('category', 'writter')->get();
        if($post){
            return PostResource::collection($post);
        } else {
            return null;
        }
    }

    public function setFeaturedPost($slug)
    {
        $post = post::where('slug', $slug)->where('deleted_at', null)->where('is_featured', false)->first();
        try {
            if($post){
                $fetured_post = post::where('deleted_at', null)->where('is_featured', true)->first();
                if($fetured_post){
                    $fetured_post->update(['is_featured' => false]);
                }
                $post->update(['is_featured' => true]);
                return $post;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getFeaturedWritter()
    {
        $writter = writter::where('is_featured', true)->orderBy('created_at','desc')->get();
        if($writter){
            return WritterResource::collection($writter);
        } else {
            return null;
        }
    }

    public function setFeaturedWritter($id, $admin_id)
    {
        $admin = User::where('uuid', $admin_id)->first(['is_admin']);

        try {
            if($admin->is_admin){
                $writter = writter::where('uuid', $id)->where('is_featured', false)->first();

                if($writter){
                    $writter->update(['is_featured' => true]);
                    return $writter;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
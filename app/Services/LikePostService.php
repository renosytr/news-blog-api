<?php

namespace App\Services;

use App\Models\post;
use App\Models\reader;
use App\Models\like_post;
use App\Http\Resources\UserNameResource;

class LikePostService
{
    public function getLikePost($slug)
    {
        $post = post::where('deleted_at', null)->where('slug', $slug)->first('id');
        $like_post = like_post::where('post_id', $post->id)->orderBy('created_at','desc')->with('reader')->get();
        
        if($like_post){
            return UserNameResource::collection($like_post);
        } else {
            return null;
        }
    }

    public function storeLike($slug, $reader_id)
    {
        $post = post::where('deleted_at', null)->where('slug', $slug)->first('id');
        $user = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $like_post = like_post::where('post_id', $post->id)->where('reader_id', $user->id)->first();

        try {
            if($post && $user && !$like_post)
            {
                $data = array();
                $data['post_id'] = $post->id;
                $data['reader_id'] = $user->id;

                $like_post = like_post::create($data);
                return $like_post;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteLike($slug, $reader_id)
    {
        $post = post::where('deleted_at', null)->where('slug', $slug)->first('id');
        $user = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $like_post = like_post::where('reader_id', $user->id)->where('post_id', $post->id)->first();

        try {
            if($like_post){
                return $like_post->delete();
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
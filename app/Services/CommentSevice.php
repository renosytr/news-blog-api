<?php

namespace App\Services;
use App\Models\post;
use App\Models\reader;
use App\Models\comment;
use App\Http\Resources\CommentResource;

class CommentSevice
{
    public function getAllComments($slug)
    {
        $post = post::where('deleted_at', null)->where('slug', $slug)->first('id');
        $comments = comment::where('post_id', $post->id)->orderBy('created_at','desc')->with('reader')->get();
        try {
            if($comments){
                return CommentResource::collection($comments);
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function storeComment($data)
    {
        $post = post::where('deleted_at', null)->where('slug', $data['slug'])->first('id');
        $user = reader::where('uuid', $data['reader_id'])->first('id');
        try {
            if($post && $user)
            {
                $data['post_id'] = $post->id;
                $data['reader_id'] = $user->id;
                $comment = comment::create($data);
                return $comment;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateComment($id, $data)
    {
        $comment = comment::where('uuid', $id)->first();
        try {
            if($comment){
                return $comment->update($data);
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteComment($id, $reader_id)
    {
        $user = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $comment = comment::where('uuid', $id)->where('reader_id', $user->id)->first();
        try {
            if($comment){
                return $comment->delete();
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
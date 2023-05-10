<?php

namespace App\Services;

use App\Models\comment;
use App\Models\reader;
use App\Models\like_comment;
use App\Http\Resources\UserNameResource;

class LikeCommentService
{
    public function getLikeComment($id)
    {
        $comment = comment::where('uuid', $id)->first('id');
        $like_comment = like_comment::where('comment_id', $comment->id)->orderBy('created_at','desc')->with('reader')->get();

        if($like_comment){
            return UserNameResource::collection($like_comment);
        } else {
            return null;
        }
    }

    public function storeLike($id, $reader_id)
    {
        $user = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $comment = comment::where('uuid', $id)->first('id');
        $like_comment = like_comment::where('comment_id', $comment->id)->where('reader_id', $user->id)->first();

        try {
            if($user && $comment && !$like_comment)
            {
                $data = array();
                $data['reader_id'] = $user->id;
                $data['comment_id'] = $comment->id;

                $like_comment = like_comment::create($data);
                return $like_comment;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteLike($id, $reader_id)
    {
        $user = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $comment = comment::where('uuid', $id)->first('id');
        $like_comment = like_comment::where('comment_id', $comment->id)->where('reader_id', $user->id)->first();

        try {
            if($like_comment){
                return $like_comment->delete();
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
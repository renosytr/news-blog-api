<?php

namespace App\Services;

use App\Models\writter;
use App\Models\reader;
use App\Models\follow;
use App\Http\Resources\FollowingResource;
use App\Http\Resources\FollowerResource;

class FollowService
{
    public function getFollower($id)
    {
        $writter = writter::where('uuid', $id)->first('id');
        $follower = follow::where('writter_id', $writter->id)->orderBy('created_at','desc')->with('reader')->get();

        if($follower){
            return FollowerResource::collection($follower);
        } else {
            return null;
        }
    }

    public function getFollowing($id)
    {
        $reader = reader::where('uuid', $id)->first('id');
        $following = follow::where('reader_id', $reader->id)->orderBy('created_at','desc')->with('writter')->get();
        
        if($following){
            return FollowingResource::collection($following);
        } else {
            return null;
        }
    }

    public function storeFollow($id, $reader_id)
    {
        $writter = writter::where('uuid', $id)->first('id');
        $reader = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $following = follow::where('writter_id', $writter->id)->where('reader_id', $reader->id)->first();

        try {
            if($writter && $reader && !$following)
            {
                $data = array();
                $data['writter_id'] = $writter->id;
                $data['reader_id'] = $reader->id;

                $following = follow::create($data);
                return $following;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteFollow($id, $reader_id)
    {
        $writter = writter::where('uuid', $id)->first('id');
        $reader = reader::where('uuid', $reader_id['reader_id'])->first('id');
        $following = follow::where('writter_id', $writter->id)->where('reader_id', $reader->id)->first();

        try {
            if($following){
                return $following->delete();
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
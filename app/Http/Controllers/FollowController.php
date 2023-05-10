<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\like_follow_reader\StoreRequest;
use App\Services\FollowService;

class FollowController extends Controller
{
    public function showFollower(String $id, FollowService $followService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Writter ID is required"
            ], 422);
        }

        $follower = $followService->getFollower($id);
        if(count($follower) != 0){
            return response()->json([
                "status" => 200,
                "data" => $follower
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Follower data is empty"
            ], 404);
        }
    }

    public function showFollowing(String $id, FollowService $followService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Reader ID is required"
            ], 422);
        }

        $following = $followService->getFollowing($id);
        if(count($following) != 0){
            return response()->json([
                "status" => 200,
                "data" => $following
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Following data is empty"
            ], 404);
        }
    }

    public function store(StoreRequest $request, String $id, FollowService $followService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Writter ID is required"
            ], 422);
        }

        $following = $followService->storeFollow($id, $request->getReader());
        if($following){
            return response()->json([
                "status" => 201,
                "message" => "Successfully follow a writter"
            ], 201);
        } else {
            return response()->json([
                "status" => 422,
                "message" => "Failed follow a writter"
            ], 422);
        }
    }

    public function destroy(StoreRequest $request, String $id, FollowService $followService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Writter ID is required"
            ], 422);
        }

        $following = $followService->deleteFollow($id, $request->getReader());
        if($following){
             return response()->json([
                 "status" => 201,
                 "message" => "Successfully unfollow a writter"
             ], 201);
        } else {
             return response()->json([
                 "status" => 404,
                 "message" => "User is not found, only reader who already follow could unfollow a writter"
             ], 404);
        }
    }
}

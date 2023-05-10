<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\like_follow_reader\StoreRequest;
use App\Services\LikePostService;

class LikePostController extends Controller
{
    public function show(String $slug, LikePostService $likePostService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }
        
        $like_post = $likePostService->getLikePost($slug);
        if(count($like_post) != 0){
            return response()->json([
                "status" => 200,
                "data" => $like_post
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Like post data is empty"
            ], 404);
        }
    }

    public function store(StoreRequest $request, String $slug, LikePostService $likePostService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }

        $like_post = $likePostService->storeLike($slug, $request->getReader());
        if($like_post){
            return response()->json([
                "status" => 201,
                "message" => "Successfully like a post"
            ], 201);
        } else {
            return response()->json([
                "status" => 422,
                "message" => "Failed like a post"
            ], 422);
        }
    }

    public function destroy(StoreRequest $request, String $slug, LikePostService $likePostService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }
        
        $like_post = $likePostService->deleteLike($slug, $request->getReader());
        if($like_post){
             return response()->json([
                 "status" => 201,
                 "message" => "Successfully delete data like"
             ], 201);
        } else {
             return response()->json([
                 "status" => 404,
                 "message" => "User is not found, only reader who already put a like could dislike"
             ], 404);
        }
    }
}

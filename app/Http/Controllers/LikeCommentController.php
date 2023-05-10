<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\like_follow_reader\StoreRequest;
use App\Services\LikeCommentService;

class LikeCommentController extends Controller
{
    public function show(String $id, LikeCommentService $likeCommentService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Like comment ID is required"
            ], 422);
        }

        $like_comment = $likeCommentService->getLikeComment($id);
        if(count($like_comment) != 0){
            return response()->json([
                "status" => 200,
                "data" => $like_comment
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Like comment data is empty"
            ], 404);
        }
    }

    public function store(StoreRequest $request, String $id, LikeCommentService $likeCommentService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Like comment ID is required"
            ], 422);
        }

        $like_comment = $likeCommentService->storeLike($id, $request->getReader());
        if($like_comment){
            return response()->json([
                "status" => 201,
                "message" => "Successfully like a comment"
            ], 201);
        } else {
            return response()->json([
                "status" => 422,
                "message" => "Failed like a comment"
            ], 422);
        }
    }

    public function destroy(StoreRequest $request, String $id, LikeCommentService $likeCommentService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Like comment ID is required"
            ], 422);
        }
        
        $like_comment = $likeCommentService->deleteLike($id, $request->getReader());
        if($like_comment){
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

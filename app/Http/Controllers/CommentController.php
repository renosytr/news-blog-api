<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\comment\StoreRequest;
use App\Http\Requests\comment\UpdateRequest;
use App\Http\Requests\comment\DeleteRequest;
use App\Services\CommentSevice;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, CommentSevice $commentService)
    {
        $comment = $commentService->storeComment($request->getComment());

        if($comment)
        {
            return response()->json([
                "status" => 201,
                "message" => "Successfully leave a comment"
            ], 201);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed leaving a comment"
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, CommentSevice $commentService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }
        
        $comment = $commentService->getAllComments($slug);

        if(count($comment) != 0){
            return response()->json([
                "status" => 200,
                "data" => $comment
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Comment data is empty"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id, CommentSevice $commentService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Post ID is required"
            ], 422);
        }

        $comment = $commentService->updateComment($id, $request->getComment());
        
        if($comment){
                return response()->json([
                    "status" => 201,
                    "message" => "Successfully update data comment"
                ], 201);
        } else {
                return response()->json([
                    "status" => 404,
                    "message" => "Comment is not found"
                ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id, CommentSevice $commentService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Post ID is required"
            ], 422);
        }

        $comment = $commentService->deleteComment($id, $request->getComment());

        if($comment){
             return response()->json([
                 "status" => 201,
                 "message" => "Successfully delete data comment"
             ], 201);
        } else {
             return response()->json([
                 "status" => 404,
                 "message" => "Comment is not found, only owner could delete the comment"
             ], 404);
        }
    }
}

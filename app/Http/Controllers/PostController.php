<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\post\StoreRequest;
use App\Http\Requests\post\UpdateRequest;
use App\Http\Requests\post\DeleteRequest;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostService $postService)
    {
        $posts = $postService->getAllPost();
        if(count($posts) != 0){
            return response()->json([
                "status" => 200,
                "data" => $posts
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Post data is empty"
            ], 404);
        }
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
    public function store(StoreRequest $request, PostService $postService)
    {
        $post = $postService->storePost($request->getPost());
        if($post){
            return response()->json([
                "status" => 201,
                "message" => "Successfully post a new content"
            ], 201);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed post a new content"
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, PostService $postService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }
        
        $post = $postService->getOnePost($slug);
        if($post){
            return response()->json([
                "status" => 200,
                "data" => $post
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Post data is not found"
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
    public function update(UpdateRequest $request, string $slug, PostService $postService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }

       $post = $postService->updatePost($slug, $request->all());
       if($post){
            return response()->json([
                "status" => 201,
                "message" => "Successfully update data post"
            ], 201);
       } else {
            return response()->json([
                "status" => 404,
                "message" => "Post is not found"
            ], 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $slug, PostService $postService)
    {
        if(!$slug){
            return response()->json([
                "status" => 422,
                "message" => "Slug of the post is required"
            ], 422);
        }

        $post = $postService->deletePost($slug, $request->getWritter());
        if($post){
             return response()->json([
                 "status" => 201,
                 "message" => "Successfully delete data post"
             ], 201);
        } else {
             return response()->json([
                 "status" => 404,
                 "message" => "Post is not found, only owner could delete the post"
             ], 404);
        }
    }
}

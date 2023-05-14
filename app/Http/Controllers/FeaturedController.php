<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\featured\StoreRequest;
use App\Services\FeaturedService;

class FeaturedController extends Controller
{
    public function showFeaturedPost(FeaturedService $featuredService)
    {      
        $featured_post = $featuredService->getFeaturedPost();
        if(count($featured_post) != 0){
            return response()->json([
                "status" => 200,
                "data" => $featured_post
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Featured post data is empty"
            ], 404);
        }
    }

    public function storeFeaturedPost(String $slug, FeaturedService $featuredService)
    {      
        $featured_post = $featuredService->setFeaturedPost($slug);
        if($featured_post){
            return response()->json([
                "status" => 200,
                "data" => "Successfully feature a post"
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed feature a post"
            ], 404);
        }
    }

    public function showFeaturedWritter(FeaturedService $featuredService)
    {
        $featured_writter = $featuredService->getFeaturedWritter();
        if(count($featured_writter) != 0){
            return response()->json([
                "status" => 200,
                "data" => $featured_writter
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Featured writter data is empty"
            ], 404);
        }
    }

    public function storeFeaturedWritter(StoreRequest $request, String $id, FeaturedService $featuredService)
    {      
        $featured_writter = $featuredService->setFeaturedWritter($id, $request->getAdmin());

        if($featured_writter){
            return response()->json([
                "status" => 200,
                "data" => "Successfully feature a writter"
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed feature a writter"
            ], 404);
        }
    }
}

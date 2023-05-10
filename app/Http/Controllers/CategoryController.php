<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\category\StoreRequest;
use App\Http\Requests\category\UpdateRequest;
use App\Http\Requests\category\DeleteRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->getAllCategory();
        if(count($categories) != 0){
            return response()->json([
                "status" => 200,
                "data" => $categories
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Categories data is empty"
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
    public function store(StoreRequest $request, CategoryService $categoryService)
    {
        $category = $categoryService->storeCategory($request->getCategory());

        if($category)
        {
            return response()->json([
                "status" => 201,
                "message" => "Successfully create category"
            ], 201);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed creating category, only admin can create a new category"
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, CategoryService $categoryService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Category ID is required"
            ], 422);
        }

        $category = $categoryService->getOneCategory($id);
        if(count($category) != 0){
            return response()->json([
                "status" => 200,
                "data" => $category
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Category is not found"
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
    public function update(UpdateRequest $request, string $id, CategoryService $categoryService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Category ID is required"
            ], 422);
        }

       $category = $categoryService->updateCategory($id, $request->all());
       if($category){
            return response()->json([
                "status" => 201,
                "message" => "Successfully update data category"
            ], 201);
       } else {
            return response()->json([
                "status" => 404,
                "message" => "Failed updating category, only admin can update a category"
            ], 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id, CategoryService $categoryService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Category ID is required"
            ], 422);
        }
        
        $category = $categoryService->deleteCategory($id, $request->getAdmin());
        if($category){
             return response()->json([
                 "status" => 201,
                 "message" => "Successfully delete data category"
             ], 201);
        } else {
             return response()->json([
                 "status" => 404,
                 "message" => "Failed deleting category, only admin can delete a category"
             ], 404);
        }
    }
}

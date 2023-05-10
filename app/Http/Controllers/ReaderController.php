<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reader;
use App\Http\Requests\reader\StoreRequest;
use App\Http\Requests\reader\UpdateRequest;
use App\Services\UserService;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserService $userService)
    {
        $reader = $userService->getAllReader();
        if(count($reader) != 0){
            return response()->json([
                "status" => 200,
                "data" => $reader
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Reader data is empty"
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
    public function store(StoreRequest $request, UserService $userService)
    {
        $userService->storeReader($request->getReader());
        return response()->json([
            "status" => 201,
            "message" => "Successfully register a new reader"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, UserService $userService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Reader ID is required"
            ], 422);
        }

        $reader = $userService->getOneReader($id);
        if($reader){
            return response()->json([
                "status" => 200,
                "data" => $reader
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Reader data is not found"
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
    public function update(UpdateRequest $request, string $id, UserService $userService)
    {
        if(!$id){
            return response()->json([
                "status" => 422,
                "message" => "Reader ID is required"
            ], 422);
        }

       $reader = $userService->updateReader($id, $request->all());
       if($reader){
            return response()->json([
                "status" => 201,
                "message" => "Successfully update data reader"
            ], 201);
       } else {
            return response()->json([
                "status" => 404,
                "message" => "Reader is not found"
            ], 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

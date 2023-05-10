<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\writter;
use App\Http\Requests\writter\StoreRequest;
use App\Http\Requests\writter\UpdateRequest;
use App\Services\UserService;

class WritterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserService $userService)
    {
        $writter = $userService->getAllWritter();
        if(count($writter) != 0){
            return response()->json([
                "status" => 200,
                "data" => $writter
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Writter data is empty"
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
        $userService->storeWritter($request->getWritter());
        return response()->json([
            "status" => 201,
            "message" => "Successfully register a new writter"
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
                "message" => "Writter ID is required"
            ], 422);
        }

        $writter = $userService->getOneWritter($id);
        if($writter){
            return response()->json([
                "status" => 200,
                "data" => $writter
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Writter data is not found"
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
                "message" => "Writter ID is required"
            ], 422);
        }

       $writter = $userService->updateWritter($id, $request->all());
       if($writter){
            return response()->json([
                "status" => 201,
                "message" => "Successfully update data writter"
            ], 201);
       } else {
            return response()->json([
                "status" => 404,
                "message" => "Writter is not found"
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

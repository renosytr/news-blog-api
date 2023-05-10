<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request, UserService $userService)
    {
        
        if($request->isWritter)
        {
            $writter = $userService->storeWritter($request->getUserData());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => $request->isAdmin,
                'writter_id' => $writter->id,
            ]);

        } else if($request->isReader) 
        {
            $reader = $userService->storeReader($request->getUserData());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => $request->isAdmin,
                'reader_id' => $reader->id
            ]);
            
        }

        return (new UserResource($user))->additional([
            "status" => 201,
            "message" => "Successfully create a new user",
        ], 201);
    }
}

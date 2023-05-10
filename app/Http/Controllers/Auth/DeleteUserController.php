<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class DeleteUserController extends Controller
{
    public function delete(string $id, AuthService $authService)
    {
        $user = $authService->deleteUser($id);

        if($user){
            return response()->json([
                "status" => 200,
                "message" => "Successfully deleting a user"
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User is not found"
            ], 404);
        }
    }
}

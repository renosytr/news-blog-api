<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\User;
use App\Http\Resources\UserResource;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request, AuthService $authService)
    {
        $credential = $request->getCredential();
        $token = $authService->login($credential);
        if ($token) {
            $user = User::where('email', $credential['email'])->first();
            $user->update(['last_login' => Carbon::now()]);
            return (new UserResource($user))->additional([
                "status" => 200,
                "message" => "Successfully login user",
                "token" => $token
            ], 200);
        } else {
            return response()->json([
                "status" => 401,
                "message" => "Credentials do not match"
            ], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(string $id, AuthService $authService)
    {       
        $logout = $authService->logout($id);
        if($logout) {
            return response()->json([
                "status" => 200,
                "message" => "Successfully logout user"
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User is not found"
            ], 404);

        }
    }
}

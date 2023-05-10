<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UserEmailRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset(ResetPasswordRequest $request, AuthService $authService)
    {
        $credential = $request->getCredential();
        
        $resetPassword = $authService->resetPassword($credential);

        if($resetPassword){
            return response()->json([
                "status" => 201,
                "message" => "Successfully reset password"
            ], 201);
       } else {
            return response()->json([
                "status" => 401,
                "message" => "Reset password failed"
            ], 401);
       }
    }

    public function forgot(UserEmailRequest $request, AuthService $authService)
    {
        $email = $request->getEmail();

        $resetPassword = $authService->forgotPassword($email);

        if($resetPassword){
            return response()->json([
                "status" => 200,
                "message" => "Reset password link has been sent to your email"
            ], 200);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User is not found"
            ], 404);
        }
    }
}

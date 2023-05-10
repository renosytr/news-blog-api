<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function sendVerification(string $id, AuthService $authService)
    {
        $verification = $authService->getVerification($id);
        switch ($verification) {
            case '404':
                return response()->json([
                    "status" => 404,
                    "message" => "Email address is not found"
                ], 404);
                break;

            case '201':
                return response()->json([
                    "status" => 201,
                    "message" => "Email address verification link has been sent"
                ], 201);
                break;

            case '200':
                return response()->json([
                    "status" => 200,
                    "message" => "Email address has already been verified"
                ]);
                break;
                
        }
    }
}

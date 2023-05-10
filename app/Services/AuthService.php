<?php

namespace App\Services;

use App\Models\User;
use App\Models\writter;
use App\Models\reader;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Carbon\Carbon;

class AuthService
{
    public function login($credential)
    {
        $user = User::where('deleted_at', null)->where('email', $credential['email'])->first();
        if (! $user || ! Hash::check($credential['password'], $user->password)) {
            return null;
        } else {
            $user->tokens()->delete();
            return $user->createToken($user->name . '-' . 'token')->plainTextToken;
        }
    }

    public function logout($id)
    {
        $user = User::where('deleted_at', null)->where('uuid', $id)->first();
        if($user) {
            $logout = $user->tokens()->delete();
            return $logout;
        } else {
            return null;
        }
    }

    public function resetPassword($credential)
    {
        $status = Password::reset(
            [
                'email' => $credential['email'], 
                'password' => $credential['password'], 
                'token' => $credential['token']
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
                $user->save();
                event(new PasswordReset($user));
            }
        );
        if ($status == Password::PASSWORD_RESET) {
            return'Password reset successfully';
        } else{
            return $status;
        }
    }

    public function forgotPassword($email)
    {
        $user = User::where('deleted_at', null)->where('email', $email)->first();

        if($user){
            $status = Password::sendResetLink($email);
            if ($status == Password::RESET_LINK_SENT) {
                return $status;
            }
        } else {
            return null;
        }
    }

    public function getVerification($id)
    {
        $user = User::where('deleted_at', null)->where('uuid', $id)->first();
        if($user){
            if($user->hasVerifiedEmail()){
                return '200';
            } else {
                $user->sendEmailVerificationNotification();
                return '201';
            }
        } else {
            return '404';
        }
    }

    public function deleteUser($id)
    {
        $user = User::where('deleted_at', null)->where('uuid', $id)->first();
        $user->tokens()->delete();
        return $user->update(['deleted_at' => Carbon::now()]);
    }

}
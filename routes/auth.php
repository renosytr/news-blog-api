<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\DeleteUserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [RegisteredUserController::class, 'store']);
Route::post('/auth/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/auth/forgot-password', [ResetPasswordController::class, 'forgot']);
Route::post('/auth/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
Route::post('/auth/recover/{email}', [DeleteUserController::class, 'recover']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/email/verification/{id}', [EmailVerificationNotificationController::class, 'sendVerification']);
    Route::get('/auth/email/verify-email/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');
    Route::post('/auth/logout/{id}', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/auth/delete/{id}', [DeleteUserController::class, 'delete']);
});

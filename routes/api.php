<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\CommentController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forget-password', [PasswordResetController::class, 'sendEmail']);
    Route::post('reset-password', [NewPasswordController::class, 'passwordResetProcess']);
    Route::post('{article_id}/comments/create', [CommentController::class, 'create']);
    Route::post('{article_id}/comments/{comment_id}', [CommentController::class, 'delete']);
});

Route::apiResource('articles', ArticleController::class);
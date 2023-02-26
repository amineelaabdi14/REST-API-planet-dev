<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EditProfileController;
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
    Route::post('{article_id}/comments/{comment_id}/delete', [CommentController::class, 'delete']);
    Route::post('{article_id}/comments/{comment_id}/edit', [CommentController::class, 'update']);
});

Route::controller(ArticleController::class)->group(function () {
    Route::post('articles', 'index');
    Route::post('article-add', 'store');
    Route::post('article/{id}', 'show');
});
Route::post('/edit-profile',[EditProfileController::class,'editInfos']);

Route::controller(CategoriesController::class)->group(function () {
Route::get('categories' , 'index');
Route::post('categories-add', 'store');
Route::post('categories-show/', 'show');
Route::put('categories-edit/', 'update');
Route::delete('categories-delete/', 'destroy');

});

// Route::apiResource('category', CategoriesController::class);

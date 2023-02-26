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
use App\Http\Controllers\RoleController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forget-password', [PasswordResetController::class, 'sendEmail']);
    Route::post('reset-password', [NewPasswordController::class, 'passwordResetProcess']);

    // Roles
    Route::group(['controller' => RoleController::class], function (){
        Route::get('roles','index')->middleware('permission:show role');
        Route::post('roles','store')->middleware('permission:add role');
        Route::get('roles/{role}','show')->middleware('permission:show role');
        Route::put('roles/{role}','update')->middleware('permission:edit role');
        Route::delete('roles/{role}','destroy')->middleware('permission:delete role');
        Route::post('roles/{id}','giveRole')->middleware('permission:assign role');
    });

    Route::group(['controller' => CommentController::class], function (){
        Route::post('{article_id}/comments/create', [CommentController::class, 'create'])->middleware('permission:add comment');
        Route::delete('{article_id}/comments/{comment_id}/delete', [CommentController::class, 'delete'])->middleware('permission:delete my comment|delete every comment');
        Route::put('{article_id}/comments/{comment_id}/edit', [CommentController::class, 'update'])->middleware('permission:edit my comment|edit every comment');
        Route::get('comments','index');
        Route::get('comments/{comment}','show');
    });

});

Route::controller(ArticleController::class)->group(function () {
    Route::get('articles', 'index');
    Route::post('articles', 'store')->middleware('permission:add article');
    Route::get('articles/{id}', 'show');
    Route::put('articles/{article}', 'update')->middleware('permission:edit my article|edit every article');
    Route::delete('articles/{article}', 'destroy')->middleware('permission:delete my article|delete every article');
});
Route::put('/edit-profile/{user}',[EditProfileController::class,'editInfos']);

Route::controller(CategoriesController::class)->group(function () {
Route::get('categories' , 'index')->middleware('permission:show category');
Route::post('categories-add', 'store')->middleware('permission:add category');
Route::post('categories-show/', 'show')->middleware('permission:show category');
Route::put('categories-edit/', 'update')->middleware('permission:edit category');
Route::delete('categories-delete/', 'destroy')->middleware('permission:delete category');

});

// Route::apiResource('category', CategoriesController::class);

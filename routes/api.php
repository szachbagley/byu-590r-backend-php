<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PublicationController;

Route::controller(RegisterController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::controller(UserController::class)->group(function(){
    Route::get('user', 'getUser');
    Route::post('user/upload_avatar', 'uploadAvatar');
    Route::delete('user/remove_avatar','removeAvatar');
    Route::post('user/send_verification_email','sendVerificationEmail');
    Route::post('user/change_email', 'changeEmail');
    });
});

Route::resource('articles', ArticleController::class);
Route::apiResource('publications',PublicationController::class)->only(['index','show']);
Route::post('articles/{article}/update_article_picture', [ArticleController::class, 'updateArticlePicture']);

<?php

use Modules\UserApi\Http\Controllers\TwilioController;
use Illuminate\Support\Facades\Route;
use Modules\UserApi\Http\Controllers\UserController;
use Modules\UserApi\Http\Controllers\AuthController;
use Modules\UserApi\Http\Controllers\FriendController;
use Modules\UserApi\Http\Controllers\GroupController;
use Modules\UserApi\Http\Controllers\MessageController;
use Modules\UserApi\Http\Controllers\ExerciseController;
use Modules\UserApi\Http\Controllers\TodoController;

Route::middleware('lang')->group(function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('social/login/{provider}', [AuthController::class, 'socialLogin']);
        Route::get('social/login/{provider}/callback', [AuthController::class, 'socialLoginCallback']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('user', [AuthController::class, 'me'])->middleware('auth.jwt');
    });
    Route::middleware('auth.jwt')->group(function () {
        Route::prefix('friends')->as('friends.')->group(function () {
            Route::get('/{userId}/all', [FriendController::class, 'getAllFriends']);
            Route::get('/{userId}/with-messages', [FriendController::class, 'getFriendsWithMessages']);
            Route::post('/search', [FriendController::class, 'findFriends']);
        });
        Route::prefix('messages')->as('messages.')->group(function () {
            Route::get('/{receiverId}', [MessageController::class, 'getMessages'])->name('get');
            Route::post('/send', [MessageController::class, 'sendMessage'])->name('send');
        });

        Route::prefix('users')->as('users.')->group(function () {
            Route::get('/{id}', [UserController::class, 'getUser'])->name('getOne');
        });

        Route::post('twilio/access_token', [TwilioController::class, 'getAccessToken']);

        Route::resource('groups', GroupController::class)->except(['create', 'edit']);
        Route::resource('todo', TodoController::class)->except(['create', 'edit']);
        Route::get('exercises', [ExerciseController::class, 'index']);
        Route::get('exercises/{id}', [ExerciseController::class, 'show']);
        Route::get('exercises/groups/{groupId}', [ExerciseController::class, 'filterByGroup']);
        Route::get('/groups/{groupSlug}/channels/{channelSlug}', [GroupController::class, 'getChannel']);
    });
});

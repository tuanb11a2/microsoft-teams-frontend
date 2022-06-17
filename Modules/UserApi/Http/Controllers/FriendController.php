<?php

namespace Modules\UserApi\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\User;
use App\Transformers\SuccessResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserApi\Transformers\UserResource;

class FriendController extends Controller
{
    public function getAllFriends(int $userId): UserResource
    {
        $friends = User::query()->whereHas('friends', function (Builder $query) use ($userId) {
            $query->where('friend_id', $userId);
        })->whereHas('messages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId)->orderByDesc('created_at');
        })->get();

        return UserResource::make($friends);
    }

    public function getFriendsWithMessages(int $userId): UserResource
    {
        $friendsWithMessages = User::query()->whereHas('friends', function (Builder $query) use ($userId) {
            $query->where('friend_id', $userId);
        })->whereHas('messages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId)->orderByDesc('created_at');
        })->with('messages', function ($query) {
            $query->limit(10)->orderByDesc('created_at');
        })->get();


        return UserResource::make($friendsWithMessages);
    }

    public function findFriends(Request $request): UserResource
    {   
        $user = Auth::user();
        $friends = $user->whereHas('friends')->where('name', 'like', '%'.$request->get('keyword').'%')->get();
        
        return UserResource::make($friends);
    }

    public function addFriend(int $friendId): SuccessResource
    {
        $user = Auth::user();
        $user->friends()->create([
            'friend_id' => $friendId
        ]);

        return new SuccessResource();
    }

    public function removeFriend(int $friendId): SuccessResource
    {
        $user = Auth::user();
        $friend = $user->friends()->find($friendId);

        if (!$friend) {
            throw ApiException::notFound('Bạn không có quan hệ bạn bè với người dùng này!');
        }

        $friend->delete();

        return new SuccessResource();
    }
}

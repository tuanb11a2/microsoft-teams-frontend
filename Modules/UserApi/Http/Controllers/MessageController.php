<?php

namespace Modules\UserApi\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserApi\Transformers\MessageResource;
use Modules\UserApi\Transformers\UserResource;

class MessageController extends Controller
{
    public function sendMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->get('receiverId'),
            //            'group_id' => $request->get('groupId'),
            'content' => $request->get('content')
        ]);

        broadcast(new MessageSent($message));

        return response()->json(['message' => 'success']);
    }

    public function getMessages($receiverId): MessageResource
    {
        $userId = Auth::user()->id;
        $messages = Message::query()
            ->where([['receiver_id', $receiverId], ['sender_id', $userId]])
            ->orWhere([['receiver_id', $userId], ['sender_id', $receiverId]])
            ->orderBy('created_at')->get();

        return MessageResource::make($messages);
    }
}

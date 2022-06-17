<?php

namespace Modules\UserApi\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Routing\Controller;
use Modules\UserApi\Transformers\UserResource;

class UserController extends Controller
{
    public function getUser(int $id): UserResource
    {
        $user = User::query()->find($id);
        if(!$user) {
            throw ApiException::notFound();
        }

        return UserResource::make($user);
    }
}

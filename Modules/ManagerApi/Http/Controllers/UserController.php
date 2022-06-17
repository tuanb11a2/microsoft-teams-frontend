<?php

namespace Modules\ManagerApi\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Transformers\SuccessResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\ManagerApi\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public const PER_PAGE = 10;

    public function index(): UserResource
    {
        $users = User::query()->withCount('groups')->orderByDesc('created_at')->paginate(self::PER_PAGE);

        return UserResource::make($users);
    }

    public function update(UpdateUserRequest $request, int $id): SuccessResource
    {
        $user = $this->findUserById($id);

        $user->update([$request->all()]);

        return new SuccessResource();
    }

    public function delete(int $id): SuccessResource
    {
        $user = $this->findUserById($id);

        $user->delete();

        return new SuccessResource();
    }
    
    private function findUserById(int $id): ?User
    {
        $user = User::query()->find($id);

        if (!$user) {
            throw ApiException::notFound('Người dùng không tồn tại');
        }

        return $user;
    }
}
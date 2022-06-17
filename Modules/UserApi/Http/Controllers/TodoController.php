<?php

namespace Modules\UserApi\Http\Controllers;

use App\Models\Group;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\UserApi\Transformers\TodoResource;
use Illuminate\Support\Str;


class TodoController extends Controller
{
    public function index()
    {
        $todoList = Todo::query()->where('user_id', auth()->user()->id)->with(['group', 'user'])->orderBy('deadline')->get();

        return TodoResource::make($todoList);
    }

    public function search(Request $request)
    {
    }

    // public function store(Request $request)
    // {
    //     $group = Group::query()->create([
    //         'name' => $request->get('name'),
    //         'description' => $request->get('description'),
    //         'slug' => Str::uuid()->toString(),
    //     ]);

    //     $group->users()->attach([
    //         'user_id' => $request->get('user_id'),
    //     ]);

    //     return GroupResource::make($group);
    // }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}

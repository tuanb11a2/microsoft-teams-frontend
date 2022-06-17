<?php

namespace Modules\UserApi\Http\Controllers;

use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\UserApi\Transformers\GroupResource;
use Illuminate\Support\Str;


class ChannelController extends Controller
{
    public function index()
    {
        $groups = Group::query()->whereHas('users', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return GroupResource::make($groups);
    }

    public function search(Request $request)
    {
    }

    public function show(string $group) {
        $group = Group::query()->where('slug', $group)->with('channels')->with('channels.messages')->with('channels.messages.user')->first();

        return GroupResource::make($group);
    }

    public function store(Request $request)
    {
        $group = Group::query()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'slug' => Str::uuid()->toString(),
        ]);

        $group->users()->attach([
            'user_id' => $request->get('user_id'),
        ]);

        return GroupResource::make($group);
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}

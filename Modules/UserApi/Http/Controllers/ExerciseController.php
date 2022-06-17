<?php

namespace Modules\UserApi\Http\Controllers;

use App\Models\Group;
use App\Models\Exercise;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\UserApi\Transformers\ExerciseResource;
use Illuminate\Support\Str;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::query()->whereHas('users', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->with('group')->orderByDesc('updated_at')->get();

        return ExerciseResource::make($exercises);
    }

    public function filterByGroup(int $groupId)
    {
        $exercises = Exercise::query()->whereHas('users', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->where('group_id', $groupId)->with('group')->orderByDesc('updated_at')->get();

        return ExerciseResource::make($exercises);
    }

    public function search(Request $request)
    {
    }

    public function show(int $id) {
        $exercise = Exercise::query()->find($id);

        return ExerciseResource::make($exercise);
    }

    public function store(Request $request)
    {
       
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }

    public function getChannel (string $groupSlug, string $channelSlug)
    {

        // $group = Group::query()->where('slug', $groupSlug)->with('channels')->first();
       
        // $channel = Channel::query()->whereHas('group', function (Builder $query) use ($group) {
        //     $query->where('group_id', $group->id);
        // })->where('slug', $channelSlug)->with(['messages', 'messages.user'])->first();

        // return GroupResource::make(['group' => $group, 'channel' => $channel]); 
    }
}

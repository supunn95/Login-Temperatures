<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{

    public function index(Request $request)
    {
        $group_by = 'id';
        $group_by_order = 'DESC';

        if (isset($request->type) && isset($request->order)) {
            $group_by = $request->type;
            $group_by_order = $request->order;
        }

        $user_data = User::with(['cities' => function ($query) use ($group_by, $group_by_order) {
            $query->with(['temperatures' => function ($query) use ($group_by, $group_by_order) {
                $query->orderBy($group_by, $group_by_order);
            }]);
        }])->where('id', '=', $request->user()->id)->first();
        return new UserResource($user_data);
    }

}

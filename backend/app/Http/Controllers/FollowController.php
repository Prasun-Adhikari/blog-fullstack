<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['follow', 'getFollowers']);
    }

    public function follow(Request $request, int $followed_id) {
        $follower = $request->user();
        $follower->following()->attach($followed_id);
    }

    public function getFollowers(Request $request) {
        $user = $request->user();
        return $user->followers()->get();
    }
}

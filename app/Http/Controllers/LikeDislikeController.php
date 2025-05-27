<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeDislikeController extends Controller
{
    function like(int $id)
    {
        LikeDislike::upsert([
            'user_id' => request()->user()->id,
            'post_id' => $id,
            'like' => true,
            'created_at' => now(),
            'updated_at' => now()
        ], uniqueBy: ['user_id', 'post_id'], update: ['like', 'updated_at']);

        return back();
    }

    function dislike(int $id)
    {
        LikeDislike::upsert([
            'user_id' => request()->user()->id,
            'post_id' => $id,
            'like' => false,
            'created_at' => now(),
            'updated_at' => now()
        ], uniqueBy: ['user_id', 'post_id'], update: ['like', 'updated_at']);

        return back();
    }
}

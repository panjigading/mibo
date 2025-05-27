<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function add(Request $request, int $post_id) {
        $request->validate([
            'body' => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ], [
            'body.required' => 'The comment field cannot be empty.',
            'body.string' => 'The comment must be valid text.',
            'body.min' => 'The comment must be at least :min characters long.',
            'body.max' => 'The comment cannot exceed :max characters.',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->post_id = $post_id;
        $comment->body = $request->input('body');
        $comment->save();

        return back();
    }

    function remove(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return back();
    }
}

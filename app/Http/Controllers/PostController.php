<?php

namespace App\Http\Controllers;

use App\Models\AvailableReactionsModel;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    function create(Request $request): RedirectResponse
    {
        $rules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'image.image' => 'Gambar yang di-upload bukan gambar',
            'image.mimes' => 'Gambar yang diterima hanya yang tipenya: :values.',
            'image.max' => 'Gambar tidak boleh lebih besar dari :max kiB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->created_at = now();
        $post->updated_at = now();
        $post->image = null;

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->storePublicly('post_image', 'public');
            $post->image = $image_path;
        }

        $post->save();

        return redirect()->route('posts');
    }

    function delete(int $id): RedirectResponse
    {
        $post = Post::find($id);
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts');
    }

    function edit(int $id): View
    {
        $post = Post::find($id);
        return view('post.edit', ['post' => $post]);
    }

    function update(Request $request, int $id) {
        $post = Post::find($id);

        $rules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'image.image' => 'Gambar yang di-upload bukan gambar',
            'image.mimes' => 'Gambar yang diterima hanya yang tipenya: :values.',
            'image.max' => 'Gambar tidak boleh lebih besar dari :max kiB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->updated_at = now();

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->storePublicly('post_image', 'public');
            $post->image = $image_path;
        }

        $post->save();
        
        return redirect()->route('posts');
    }

    function index(): View
    {
        $posts = Post::join('users', 'user_id', '=', 'users.id')->
            select('posts.*', 'users.username')->
            orderBy('created_at', 'desc')->get();
        return view('posts', ['posts' => $posts]);
    }

    function remove_image(int $id): void
    {
        $post = Post::find($id);
        if ($post->image) {
            Storage::delete($post->image);
            $post->image = null;
            $post->save();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeDislike;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class GuestController extends Controller
{

    public function posts(): View
    {
        $posts = Post::join('users', 'user_id', '=', 'users.id')->
            select('posts.*', 'users.username', 'users.display_name')->
            orderBy('updated_at', 'desc')->get();
        return view('posts', ['posts' => $posts]);
    }

    public function post(int $id): View
    {
        $post = Post::join('users', 'user_id', '=', 'users.id')->
            select('posts.*', 'users.username', 'users.display_name')->find($id);

        $comments = Comment::join('users', 'user_id', '=', 'users.id')->
            select('comments.*', 'username', 'display_name')->orderBy('updated_at', 'desc')->
            get();

        $like = $post->likeDislike()->where('like', '=', true)->count();
        $dislike = $post->likeDislike()->where('like', '=', false)->count();

        return view('post', ['post' => $post, 'comments' => $comments,
            'like' => $like, 'dislike' => $dislike]);
    }

    public function user(string $username)
    {
        $user = User::where('username', '=', $username)->first();
        $posts = $user->posts()->get();
        return view('user', ['user' => $user, 'posts' => $posts, 'currentUser' => false]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('posts');
        }
        
        return back()->withErrors($credentials)->withInput(['username']);
    }

    public function signup(Request $request): RedirectResponse
    {
        $dataVlidation = $request->validate([
            'display_name' => 'string',
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string'],
        ]);

        $user = User::create([
            'display_name' => $request->input('display_name'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'profile_picture' => ''
        ]);

        if ($request->hasFile('foto_profil')) {
            $image_path = $request->file('foto_profil')->storePublicly('profiles', 'public');
            $user->foto_profil = $image_path;
        }

        return redirect()->route('login');
    }
}

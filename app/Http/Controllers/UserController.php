<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    function account(): View
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('updated_at', 'desc')->get();
        return view('user', ['user' => $user, 'posts' => $posts,
            'currentUser' => true]);
    }

    function edit(Request $request)
    {
        return view('user.edit', ['user' => $request->user()]);
    }

    function update(Request $request)
    {
        $rules = [
            'display_name' => 'required|string|max:300',
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

        $user = $request->user();
        $user->display_name = $request->input('display_name');

        if ($request->hasFile('profile_picture')) {
            Storage::delete($user->profile_picture);
            $image_path = $request->file('profile_picture')->storePublicly('profiles', 'public');
            $user->profile_picture = $image_path;
        }

        $user->save();

        return redirect()->route('user.account');
    }

    function delete(Request $request) {
        $request->user()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}

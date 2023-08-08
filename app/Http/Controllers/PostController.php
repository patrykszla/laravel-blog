<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function viewSinglePost(Post $post) {
        // return $post->title;
        $post['body'] = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><h3>');
        return view('single-post', ['post' => $post]);
    }

    public function addNewPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created');
    }

    public function showCreateForm() {
        // if (!auth()->check()) {
        //     return redirect('/');
        // }
        return view('create-post');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminPostsController extends Controller
{
    public function index()
    {
        //return view('admin.posts.index');
        $posts = Post::orderBy('created_at','DESC')->get();
        $data = ['posts' => $posts];
        return view('admin.posts.index',$data);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'reqiored|max:50',
            'content' => 'reqiored',
            'is_feature' => 'reqiored|boolean'
        ]);
        Post::create($request->all());
        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        $data = [
            'post'=>$post
        ];
        return view('admin.posts.edit', $data);
    }

    public function update(Request $request, Post $post)
    {
        $this -> validate($request, [
            'title' => 'reqiored|max:50',
            'content' => 'reqiored',
            'is_feature' => 'reqiored|boolean'
        ]);
        $post->update($request->all());
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}

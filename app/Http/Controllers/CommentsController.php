<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
    	//dd($request->user_id);
    	$post->addComment($request->description, $request->user_id);
    	return back();
    }
    public function apiIndex(Post $post)
    {
    	$comments = Comment::with(['user', 'post'])->get();

    	return $comments;
    }
    public function apiStore(Request $request)
    {
    	$e = new Comment;
    	$e->content = $request['content'];
        $e->user_id = $request['user_id'];
        $e->username = User::find($request['user_id'])->name;
        $e->post_id = $request['post_id'];
    	$e->save();
    	return $e;
    }
    public function edit($id)
   {
      $comment = Comment::findOrFail($id);
      abort_if($comment->user_id !== auth()->id(), 403);
      return view('edit_comments', compact('comment'));
   }
   public function update($id)
   {
      $comment = Comment::findOrFail($id);
      $comment->content = request('content');
      $comment->save();
      return redirect('/posts');
   }
   public function destroy($id)
   {
      $comment = Comment::findOrFail($id);
      abort_if($comment->user_id !== auth()->id(), 403);
      $comment->delete();

      return redirect('/posts');
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PagesController extends Controller
{
  /*public function __construct()
  {
    $this->middleware('auth');
  }*/
   public function create(){
      return view('create');
  }
   public function home(){
      return view('welcome');
   }
   public function index(){
   	  $posts = Post::orderBy('id', 'desc')->get();
   	  return view('index', compact("posts"));
   }
   public function store(Request $request){
      request()->validate([
        'title' => 'required',
        'content' => 'required',
        'user_id' => 'required'
      ]);
      Post::create(request([
        'content',
        'user_id',
        'title'
      ]));
   	  return redirect('/posts');
   }
   public function edit($id)
   {
      $post = Post::findOrFail($id);
      abort_if($post->user_id !== auth()->id(), 403);
      dd(User::findOrFail($post->user_id)->type);
      return view('edit', compact('post'));
   }
   public function update($id)
   {
      $post = Post::findOrFail($id);

      $post->title = request('title');
      $post->content = request('content');
      $post->save();

      return redirect('/posts');

   }
   public function destroy($id)
   {
      $post = Post::findOrFail($id);
      abort_if($post->user_id !== auth()->id(), 403);
      $post->delete();

      return redirect('/posts');
   }
}

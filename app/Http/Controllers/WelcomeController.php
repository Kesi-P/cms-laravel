<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
      $search = request()->query('search');

      if($search){
        $posts = Post::where('title','LIKE','%'.$search.'%')->paginate(1);
      }else {
        $posts = Post::paginate(1);
      }

      return view('welcome')->with('categories',Category::all())
      ->with('tags',Tag::all())
      ->with('posts',$posts);

      // return view('partial.sidebar')->with('categories',Category::all())
      // ->with('tags',Tag::all())
      // ->with('posts',$posts);
    }
}

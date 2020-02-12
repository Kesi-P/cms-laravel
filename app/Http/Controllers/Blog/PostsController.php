<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
class PostsController extends Controller
{
    public function show(Post $post)
    {
      return view('blog.show')->with('post',$post)->with('tags',Tag::all());
    }

    public function category(Category $category)
    {
      return view('blog.category')->with('category' , $category)->with('posts',$category->post()->paginate(1))
      ->with('categories', Category::all())
      ->with('tags',Tag::all());
    }

    public function tag(Tag $tag)
    {
      return view('blog.tag')->with('tag' , $tag)->with('posts',$tag->post()->paginate(1))
      ->with('categories', Category::all())
      ->with('tags',Tag::all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\RequestPost\CreatePost;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('allpost', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePost $request)
    {
      ////dd($request->image->store('posts')); it return "posts/fELTpCPuwDgLVyFeWAev5rebrc7TDerZLoL028u0.jpeg"  generat auto file in storage/app/post
        //uploadimage
        $image = $request->image->store('posts');
        //CreatePosts
        Post::create([
          'title' =>$request->title,
          'description' =>$request->description,
          'content'=>$request->content,
          'image'=>$image
        ]);
        //flash message
        session()->flash('success','Post Created');
        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //Post $post doesn't work with trash id
    {
      $post = Post::withTrashed()->where('id',$id)->firstOrFail();
      if($post->trashed()){
        $post->forceDelete();
      }else {
          $post->delete();
      }

        session()->flash('success','Post Trashed');
        return redirect(route('posts.index'));
    }

    /**
     * Display of all trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
      $trashpost = Post::onlyTrashed()->get();
      return view('posts.index')->with('allpost', $trashpost);
    }
}

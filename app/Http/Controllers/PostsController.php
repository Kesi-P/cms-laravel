<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\RequestPost\CreatePost;
use App\Http\Requests\RequestPost\UpdatePost;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    public function __construct()
    {
      $this->middleware('CategorybeforePost')->only(['create']); //only to show
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //dd(Category::all()->count());
        return view('posts.index')->with('allpost', Post::all())->with('alltag',Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('allcate',Category::all())->with('alltag',Tag::all());
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
        $post = Post::create([
          'title' =>$request->title,
          'description' =>$request->description,
          'content'=>$request->content,
          'image'=>$image,
          'published_at'=>$request->published_at,
          'category_id'=>$request->category_id
        ]);

        if($request->tags){
          $post->Tags()->attach($request->tags);
        }
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
    public function edit(Post $post)
    {   //dd($post->tags->pluck('id')->toArray());
        return view('posts.create')->with('editpost', $post)->with('editcate', Category::all())->with('edittag',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
      $data = $request->only(['title','description','published_at','content','category_id']);
        //check if a new image
        if($request->hasFile('image')){
          //upload it
          $image = $request->image->store('posts');
          //delete old image
          $post->deleteImage();
          $data['image'] = $image;
        };

        if($request->tags){
          $post->Tags()->sync($request->tags); //sync to db if user unselect, not select.. help for m2m relationship
        }
        //update atrr
        $post->update($data);
        session()->flash('success','Post Updated');
        return redirect(route('posts.index'));
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
        $post->deleteImage(); //call it from modal
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
    public function restore($id) //find the id from trash
    {
      Post::withTrashed()->where('id', $id)->restore();
      session()->flash('success','Post Restore');
      return redirect()->back();
    }
}

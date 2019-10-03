<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\RequestTag\StoreTags;
use App\Http\Requests\RequestTag\UpdateTags;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all()); //fetch all tags
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetags $request)//automatically inject the instance
    {

        Tag::create([    //tags = tablename,model
          'name' => $request->name //creat brand new tags name
        ]);

        session()->flash('success', ' tags is created');
        return redirect(route('tags.index'));
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
    public function edit($id) // use dynamic id from tags/{tags}/edit to find in the model
    {   $tags = Tag::find($id);
        return view('tags.create')->with('tagsid' , $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetags $request,$id)
    {
       $tags = Tag::find($id);
       $tags->update([
          'name' => $request->name
        ]);
        session()->flash('success', ' tags is updated');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tag::find($id);
        $tags->Post()->detach();
        $tags->delete(); //find the query in table by id
        return redirect(route('tags.index'));
    }
}

@extends('layouts.app')

@section('content')

<div class="card card-default">
  <div class="card-header">
    {{ isset($tag) ? 'Edit Category' : ' Create Category'}}
  </div>
  <div class="card-body">
   @include('partial.error')
    <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="POST">
      @csrf
      @if(isset($tag))
      @method('PUT') <!--As form can have put or get but for update we need to put , this is how to tell laravel-->
      @endif
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($tag) ? $tag->name : '' }}">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">{{ isset($tag) ? 'Save Tag' : ' Add Tag'}}</button>
      </div>

    </form>
  </div>
</div>
@endsection

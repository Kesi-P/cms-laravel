@extends('layouts.app')

@section('content')

<div class="card card-default">
  <div class="card-header">
    {{ isset($tagsid) ? 'Edit Tag' : ' Create Tag'}}
  </div>
  <div class="card-body">
   @include('partial.error')
    <form action="{{ isset($tagsid) ? route('tags.update',$tagsid->id) : route('tags.store') }}" method="POST">
      @csrf
      @if(isset($tagsid))
      @method('PUT') <!--As form can have put or get but for update we need to put , this is how to tell laravel-->
      @endif
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($tagsid) ? $tagsid->name : '' }}">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">{{ isset($tagsid) ? 'Save Tag' : ' Add Tag'}}</button>
      </div>

    </form>
  </div>
</div>
@endsection
